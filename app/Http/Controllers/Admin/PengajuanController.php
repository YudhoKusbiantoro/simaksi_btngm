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
        return view('admin.pengajuan.show', compact('pengajuan'));
    }

    public function updateStatus(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'status' => 'required|in:menunggu,disetujui,ditolak,revisi',
            'catatan' => 'nullable|string',
        ]);

        $pengajuan->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
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
            'lokasi' => 'required|string|max:255',
            'tujuan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $pengajuan->update($validated);

        return redirect()->back()->with('success', 'Data pengajuan berhasil diperbarui.');
    }
}
