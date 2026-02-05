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
        ]);

        $approvalExist = SimaksiApproval::where('pengajuan_id', $pengajuan->id)->first();

        // Cek apakah kode_surat berubah. Jika berubah, regenerasi nomor_surat
        $kodeSurat = $request->kode_surat;
        $nomorSurat = $approvalExist ? $approvalExist->nomor_surat : $this->generateNomorSurat($kodeSurat);

        if ($approvalExist && $approvalExist->kode_surat !== $kodeSurat) {
            // Jika kode berubah, kita rebuild nomor suratnya tapi tetap pakai urutan yang sama
            $parts = explode('/', $approvalExist->nomor_surat);
            // parts[0] = SL. XX, parts[1] = T.36, parts[2] = TU, parts[3] = Lit.0.0, parts[4] = MM, parts[5] = YYYY
            if (count($parts) >= 6) {
                $nomorSurat = "{$parts[0]}/{$parts[1]}/{$parts[2]}/{$kodeSurat}/{$parts[4]}/{$parts[5]}";
            } else {
                // Fallback jika format entah kenapa berubah
                $nomorSurat = $this->generateNomorSurat($kodeSurat);
            }
        }

        // Tanggal Terbit (Hanya jika baru, atau tetap gunakan tanggal terbit pertama?)
        // User minta: "Tanggal terbit otomatis diambil dari hari ini saat tombol ditekan"
        // Namun biasanya nomor surat terikat dengan tanggal. Jika nomor tetap, mungkin tanggal juga tetap?
        // Tapi user bilang: "Tanggal Terbit TIDAK diinput manual... otomatis diambil dari tanggal hari ini... saat tombol Cetak ditekan"
        // Untuk amannya, saya akan update tanggal terbit ke hari ini setiap kali cetak (seperti permintaan awal) 
        // namun tetap mempertahankan nomor surat jika sudah ada.
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

    private function generateNomorSurat($kodeSurat = 'Lit.0.0')
    {
        $tahun = Carbon::now()->year;
        $bulan = Carbon::now()->format('m');

        // Cari nomor urut terakhir di tahun ini
        $lastApproval = SimaksiApproval::whereYear('tanggal_terbit', $tahun)
            ->orderBy('id', 'desc')
            ->first();

        $noUrut = 1;
        if ($lastApproval) {
            // Ambil nomor urut dari string "SL. XX/..."
            $parts = explode('/', $lastApproval->nomor_surat);
            if (isset($parts[0])) {
                // Ambil bagian setelah "SL. "
                $noPart = str_replace('SL. ', '', $parts[0]);
                $noUrut = (int) $noPart + 1;
            }
        }

        $noUrutFormatted = str_pad($noUrut, 2, '0', STR_PAD_LEFT);

        return "SL. {$noUrutFormatted}/T.36/TU/{$kodeSurat}/{$bulan}/{$tahun}";
    }

    private function generatePDF(Pengajuan $pengajuan, SimaksiApproval $approval)
    {
        $pengajuan->load(['user', 'jenisKegiatan', 'anggotas']);
        $tanggal_cetak = Carbon::parse($approval->tanggal_terbit)->translatedFormat('d F Y');

        // Ambil pengaturan dari database
        $kasubagNama = Setting::where('key', 'kasubag_tu_nama')->first()?->value ?? 'Endarmiyati, S. Si, M. Sc.';
        $kasubagNip = Setting::where('key', 'kasubag_tu_nip')->first()?->value ?? '197510112002122002';

        $data = [
            'pengajuan' => $pengajuan,
            'approval' => $approval,
            'tanggal_cetak' => $tanggal_cetak,
            'kasubagNama' => $kasubagNama,
            'kasubagNip' => $kasubagNip,
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

        return Storage::disk('public')->download($approval->file_pdf);
    }
}
