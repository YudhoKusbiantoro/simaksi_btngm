<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisKegiatan;
use App\Models\Persyaratan;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth; // ← Tambahkan ini
use Illuminate\Support\Str; // ← Tambahkan ini

class AjukanController extends Controller
{
    public function index()
    {
        $jenisKegiatans = JenisKegiatan::all();
        return view('ajukan', compact('jenisKegiatans'));
    }

    public function getPersyaratan(Request $request)
    {
        $jenisKegiatanId = $request->query('jenis_kegiatan_id');
        $kewarganegaraan = $request->query('kewarganegaraan');

        if (!$jenisKegiatanId || !$kewarganegaraan) {
            return response()->json([]);
        }

        $persyaratans = Persyaratan::where('jenis_kegiatan_id', $jenisKegiatanId)
            ->where('kewarganegaraan', $kewarganegaraan)
            ->pluck('nama_dokumen')
            ->unique()
            ->values();

        return response()->json($persyaratans);
    }

    public function store(Request $request)
    {
        // Validasi form utama
        $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'identitas' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'tujuan' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'jenis_kegiatan_id' => 'required|exists:jenis_kegiatans,id',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'tanggal_mulai' => 'required|date|after_or_equal:' . now()->addDays(14)->toDateString(),
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Ambil daftar dokumen wajib
        $dokumenWajib = Persyaratan::where('jenis_kegiatan_id', $request->jenis_kegiatan_id)
            ->where('kewarganegaraan', $request->kewarganegaraan)
            ->pluck('nama_dokumen')
            ->unique()
            ->values();

        // Validasi file untuk setiap dokumen
        $rules = [];
        foreach ($dokumenWajib as $index => $dok) {
            $fieldName = "file_" . Str::slug($dok, '_'); // ← Pakai Str::slug
            $rules[$fieldName] = 'required|file|mimes:pdf,jpg,jpeg,png|max:1024';
        }
        $messages = [
            'max' => 'Ukuran file tidak boleh lebih dari 1 MB.',
            'mimes' => 'Format file harus PDF, JPG, JPEG, atau PNG.',
            'required' => 'Dokumen wajib diunggah.',
        ];

        $request->validate($rules, $messages);

        // Simpan pengajuan
        $pengajuan = Pengajuan::create([
            'user_id' => Auth::id(),
            'nama_pemohon' => $request->nama_pemohon,
            'identitas' => $request->identitas,
            'jabatan' => $request->jabatan,
            'instansi' => $request->instansi,
            'tujuan' => $request->tujuan,
            'lokasi' => $request->lokasi,
            'jenis_kegiatan_id' => $request->jenis_kegiatan_id,
            'kewarganegaraan' => $request->kewarganegaraan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'menunggu',
        ]);

        // Simpan File ke Storage & Tabel PengajuanDokumen
        foreach ($dokumenWajib as $dok) {
            $fieldName = "file_" . Str::slug($dok, '_');
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $filename = time() . '_' . Str::slug($dok, '_') . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('pengajuan/' . $pengajuan->id, $filename, 'public');

                \App\Models\PengajuanDokumen::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nama_dokumen' => $dok,
                    'file_path' => $path,
                ]);
            }
        }

        // Simpan Anggota
        if ($request->has('anggota')) {
            foreach ($request->anggota as $item) {
                if (!empty($item['nama'])) {
                    $pengajuan->anggotas()->create([
                        'nama' => $item['nama'],
                        'identitas' => $item['identitas'],
                        'peran' => $item['peran'],
                    ]);
                }
            }
        }

        // Log status awal
        \App\Models\PengajuanStatusLog::create([
            'pengajuan_id' => $pengajuan->id,
            'status' => 'menunggu',
            'catatan' => 'Permohonan baru diajukan.',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan SIMAKSI berhasil diajukan!');
    }

    public function edit(Pengajuan $pengajuan)
    {
        // Pastikan milik user yang login dan statusnya revisi
        if ($pengajuan->user_id !== Auth::id() || $pengajuan->status !== 'revisi') {
            abort(403);
        }

        $jenisKegiatans = JenisKegiatan::all();
        $dokumens = $pengajuan->dokumens;

        return view('ajukan_revisi', compact('pengajuan', 'jenisKegiatans', 'dokumens'));
    }

    public function update(Request $request, Pengajuan $pengajuan)
    {
        if ($pengajuan->user_id !== Auth::id() || $pengajuan->status !== 'revisi') {
            abort(403);
        }

        // Ambil daftar dokumen wajib
        $dokumenWajib = Persyaratan::where('jenis_kegiatan_id', $pengajuan->jenis_kegiatan_id)
            ->where('kewarganegaraan', $pengajuan->kewarganegaraan)
            ->pluck('nama_dokumen')
            ->unique()
            ->values();

        // Validasi file (optional, because maybe only some files need update, but usually better to re-upload if requested)
        $rules = [];
        foreach ($dokumenWajib as $dok) {
            $fieldName = "file_" . Str::slug($dok, '_');
            $rules[$fieldName] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024';
        }
        $request->validate($rules);

        // Update files
        foreach ($dokumenWajib as $dok) {
            $fieldName = "file_" . Str::slug($dok, '_');
            if ($request->hasFile($fieldName)) {
                // Delete old file if exists
                $oldDok = $pengajuan->dokumens()->where('nama_dokumen', $dok)->first();
                if ($oldDok) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($oldDok->file_path);
                    $oldDok->delete();
                }

                $file = $request->file($fieldName);
                $filename = time() . '_' . Str::slug($dok, '_') . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('pengajuan/' . $pengajuan->id, $filename, 'public');

                \App\Models\PengajuanDokumen::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nama_dokumen' => $dok,
                    'file_path' => $path,
                ]);
            }
        }

        // Set status back to 'menunggu' dan tandai sebagai kiriman revisi
        $pengajuan->update([
            'status' => 'menunggu',
            'is_revisi_submitted' => true,
        ]);

        // Log status revisi telah dikirim
        \App\Models\PengajuanStatusLog::create([
            'pengajuan_id' => $pengajuan->id,
            'status' => 'sudah di revisi',
            'catatan' => 'Pemohon telah mengunggah dokumen revisi.',
        ]);

        return redirect()->route('dashboard')->with('success', 'Dokumen revisi berhasil diunggah. Menunggu verifikasi ulang.');
    }
}