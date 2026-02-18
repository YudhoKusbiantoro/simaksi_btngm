<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengajuan::with(['user', 'jenisKegiatan']);

        if ($request->filled('search')) {
            $query->where('nama_pemohon', 'like', '%' . $request->search . '%');
        }

        $pengajuans = $query->latest()->get();
        return view('admin.pengajuan.index', compact('pengajuans'));
    }

    public function show(Pengajuan $pengajuan)
    {
        $pengajuan->load(['user', 'jenisKegiatan', 'anggotas', 'dokumens', 'statusLogs']);

        // Ambil data penandatangan dari settings
        $settings = \App\Models\Setting::whereIn('key', [
            'kasubag_tu_nama',
            'kasubag_tu_nip',
            'kasubag_tu_jabatan',
            'ttd_2_nama',
            'ttd_2_nip',
            'ttd_2_jabatan'
        ])->get()->keyBy('key');

        $ttd_a = [
            'nama' => $settings->get('kasubag_tu_nama')?->value ?? '',
            'nip' => $settings->get('kasubag_tu_nip')?->value ?? '',
            'jabatan' => $settings->get('kasubag_tu_jabatan')?->value ?? '',
        ];

        $ttd_b = [
            'nama' => $settings->get('ttd_2_nama')?->value ?? '',
            'nip' => $settings->get('ttd_2_nip')?->value ?? '',
            'jabatan' => $settings->get('ttd_2_jabatan')?->value ?? '',
        ];

        return view('admin.pengajuan.show', compact('pengajuan', 'ttd_a', 'ttd_b'));
    }

    public function updateStatus(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'status' => 'required|in:menunggu,disetujui,dijadwalkan presentasi,revisi',
            'catatan' => 'nullable|string',
            'zoom_link' => 'nullable|url',
            'jadwal_presentasi' => 'nullable|date',
        ]);

        $pengajuan->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
            'zoom_link' => $request->status === 'dijadwalkan presentasi' ? $request->zoom_link : $pengajuan->zoom_link,
            'jadwal_presentasi' => $request->status === 'dijadwalkan presentasi' ? $request->jadwal_presentasi : $pengajuan->jadwal_presentasi,
            'is_revisi_submitted' => false,
        ]);

        // Log status change
        \App\Models\PengajuanStatusLog::create([
            'pengajuan_id' => $pengajuan->id,
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    public function updateData(Request $request, Pengajuan $pengajuan)
    {
        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'identitas' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'nomor_hp' => 'nullable|string|max:20',
            'lokasi' => 'required|string|max:255',
            'tujuan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $pengajuan->update($validated);

        return redirect()->back()->with('success', 'Data pengajuan berhasil diperbarui.');
    }
}
