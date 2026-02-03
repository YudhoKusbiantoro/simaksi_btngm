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
            'jenis_kegiatan_id' => 'required|exists:jenis_kegiatans,id',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
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
            'user_id' => Auth::id(), // ← Pakai Auth::id()
            'jenis_kegiatan_id' => $request->jenis_kegiatan_id,
            'kewarganegaraan' => $request->kewarganegaraan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'menunggu',
        ]);

        // Nanti: simpan file ke storage & buat tabel terpisah untuk dokumen

        return redirect()->route('dashboard')->with('success', 'Pengajuan SIMAKSI berhasil diajukan!');
    }
}