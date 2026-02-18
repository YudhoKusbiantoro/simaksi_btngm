<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\SimaksiApproval;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SimaksiApprovalController extends Controller
{
    public function store(Request $request, Pengajuan $pengajuan)
    {
        // Validasi status
        if ($pengajuan->status !== 'disetujui') {
            return back()->with('error', 'SIMAKSI hanya bisa dicetak jika status sudah Disetujui.');
        }

        // Validasi input manual
        $request->validate([
            'kode_surat' => 'required|string',
            'keterangan_surat_pengantar' => 'required|string',
            'tarif_pnbp' => 'required|numeric',
            'catatan_admin' => 'nullable|string',
            'tembusan' => 'nullable|string',
            'penandatangan_nama' => 'required|string',
            'penandatangan_nip' => 'required|string',
            'penandatangan_jabatan' => 'required|string',
        ]);

        $approvalExist = SimaksiApproval::where('pengajuan_id', $pengajuan->id)->first();

        // Cek apakah kode_surat berubah. Jika berubah, regenerasi nomor_surat
        $kodeSurat = strtoupper($request->kode_surat);
        $nomorSurat = $approvalExist ? $approvalExist->nomor_surat : $this->generateNomorSurat($kodeSurat);

        // Pastikan prefix SI dan Kode Kapital terupdate meskipun data sudah ada
        if ($approvalExist) {
            $nomorSurat = str_replace('SL. ', 'SI. ', $nomorSurat);

            $parts = explode('/', $nomorSurat);
            if (count($parts) >= 6) {
                // Pastikan bagian kode (index 3) diperbarui dan kapital
                $parts[3] = $kodeSurat;
                $nomorSurat = implode('/', $parts);
            }
        }

        // Tanggal Terbit
        $tanggalTerbit = Carbon::now();

        // Simpan atau Update Approval
        $approval = SimaksiApproval::updateOrCreate(
            ['pengajuan_id' => $pengajuan->id],
            [
                'nomor_surat' => $nomorSurat,
                'kode_surat' => $kodeSurat,
                'tanggal_terbit' => $tanggalTerbit,
                'keterangan_surat_pengantar' => $request->keterangan_surat_pengantar,
                'tarif_pnbp' => $request->tarif_pnbp,
                'catatan_admin' => $request->catatan_admin,
                'tembusan' => $request->tembusan,
                'penandatangan_nama' => $request->penandatangan_nama,
                'penandatangan_nip' => $request->penandatangan_nip,
                'penandatangan_jabatan' => $request->penandatangan_jabatan,
            ]
        );

        // Generate PDF
        $pdfPath = $this->generatePDF($pengajuan, $approval);

        // Update path PDF di database
        $approval->update(['file_pdf' => $pdfPath]);

        return redirect()->route('admin.pengajuan.preview-pdf', $pengajuan->id)
            ->with('success', 'PDF SIMAKSI berhasil di-generate! Silakan tinjau sebelum cetak.');
    }

    public function previewPDF(Pengajuan $pengajuan)
    {
        $approval = $pengajuan->approval;

        if (!$approval || !$approval->file_pdf) {
            return redirect()->route('admin.pengajuan.show', $pengajuan->id)
                ->with('error', 'File PDF belum di-generate.');
        }

        return view('admin.pengajuan.preview', compact('pengajuan', 'approval'));
    }

    private function generateNomorSurat($kodeSurat = 'LIT.0.0')
    {
        $tahun = Carbon::now()->year;
        $bulan = Carbon::now()->format('m');

        // Cari nomor urut terakhir di tahun ini
        $lastApproval = SimaksiApproval::whereYear('tanggal_terbit', $tahun)
            ->orderBy('id', 'desc')
            ->first();

        $noUrut = 1;
        if ($lastApproval) {
            // Ambil nomor urut dari string "SI. XX/..."
            $parts = explode('/', $lastApproval->nomor_surat);
            if (isset($parts[0])) {
                // Ambil bagian setelah "SI. "
                $noPart = str_replace('SI. ', '', str_replace('SL. ', '', $parts[0]));
                $noUrut = (int) $noPart + 1;
            }
        }

        $noUrutFormatted = str_pad($noUrut, 2, '0', STR_PAD_LEFT);

        return "SI. {$noUrutFormatted}/T.36/TU/{$kodeSurat}/{$bulan}/{$tahun}";
    }

    private function generatePDF(Pengajuan $pengajuan, SimaksiApproval $approval)
    {
        $pengajuan->load(['user', 'jenisKegiatan', 'anggotas']);
        $tanggal_cetak = Carbon::parse($approval->tanggal_terbit)->locale('id')->translatedFormat('d F Y');

        // Ambil ketentuan dari settings
        $ketentuanSetting = \App\Models\Setting::where('key', 'simaksi_ketentuan')->first()?->value ?? '';
        $ketentuan = array_filter(explode("\n", str_replace("\r", "", $ketentuanSetting)));

        $data = [
            'pengajuan' => $pengajuan,
            'approval' => $approval,
            'tanggal_cetak' => $tanggal_cetak,
            'kasubagNama' => $approval->penandatangan_nama,
            'kasubagNip' => $approval->penandatangan_nip,
            'kasubagJabatan' => $approval->penandatangan_jabatan,
            'ketentuan' => $ketentuan,
        ];

        $pdf = Pdf::loadView('admin.pengajuan.simaksi_pdf', $data);

        $filename = 'SIMAKSI_' . str_replace('/', '_', $approval->nomor_surat) . '.pdf';
        $path = 'simaksi_pdfs/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());

        return $path;
    }

    public function downloadPDF(Pengajuan $pengajuan)
    {
        $approval = $pengajuan->approval;

        if (!$approval || !$approval->file_pdf) {
            return back()->with('error', 'File PDF belum di-generate.');
        }

        if (!Storage::disk('public')->exists($approval->file_pdf)) {
            return back()->with('error', 'File PDF tidak ditemukan di storage.');
        }

        return response()->download(
            storage_path('app/public/' . $approval->file_pdf),
            'nama_file.pdf'
        );
    }
}
