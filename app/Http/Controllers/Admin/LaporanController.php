<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\JenisKegiatan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month', now()->month);
        $selectedYear = $request->input('year', now()->year);
        $selectedJenisKegiatan = $request->input('jenis_kegiatan_id');

        $query = Pengajuan::query();

        if ($selectedMonth) {
            $query->whereMonth('created_at', $selectedMonth);
        }

        if ($selectedYear) {
            $query->whereYear('created_at', $selectedYear);
        }

        if ($selectedJenisKegiatan) {
            $query->where('jenis_kegiatan_id', $selectedJenisKegiatan);
        }

        // Rekap Status
        $rekapStatus = [
            'total' => (clone $query)->count(),
        ];

        // Laporan per Jenis Kegiatan (FILTERED)
        $jenisKegiatan = JenisKegiatan::all();
        $laporanJenis = $jenisKegiatan->map(function ($jenis) use ($query) {
            return [
                'id' => $jenis->id,
                'nama' => $jenis->nama,
                'total' => (clone $query)->where('jenis_kegiatan_id', $jenis->id)->count(),
            ];
        });

        // Rekap Kewarganegaraan

        // Rekap Kewarganegaraan
        $rekapKewarganegaraan = [
            'wni' => (clone $query)->where('kewarganegaraan', 'WNI')->count(),
            'wna' => (clone $query)->where('kewarganegaraan', 'WNA')->count(),
        ];

        // Data for Chart
        $chartLabels = $laporanJenis->pluck('nama')->toArray();
        $chartData = $laporanJenis->pluck('total')->toArray();

        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $years = Pengajuan::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        // Ensure current year is in the list
        if (!in_array(now()->year, $years)) {
            array_unshift($years, now()->year);
        }

        // Monthly Trend Data (filtered by selected filters)
        $monthlyTrendLabels = [];
        $monthlyTrendData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyTrendLabels[] = $months[$i];
            $monthlyQuery = Pengajuan::whereYear('created_at', $selectedYear)
                ->whereMonth('created_at', $i);

            // Apply jenis kegiatan filter if selected
            if ($selectedJenisKegiatan) {
                $monthlyQuery->where('jenis_kegiatan_id', $selectedJenisKegiatan);
            }

            $monthlyTrendData[] = $monthlyQuery->count();
        }

        // Yearly Comparison Data (filtered by selected filters, excluding year filter)
        $yearlyComparisonLabels = [];
        $yearlyComparisonData = [];
        $availableYears = array_slice($years, 0, 5); // Get up to 5 most recent years
        foreach ($availableYears as $year) {
            $yearlyComparisonLabels[] = (string) $year;
            $yearlyQuery = Pengajuan::whereYear('created_at', $year);

            // Apply month filter if selected
            if ($selectedMonth) {
                $yearlyQuery->whereMonth('created_at', $selectedMonth);
            }

            // Apply jenis kegiatan filter if selected
            if ($selectedJenisKegiatan) {
                $yearlyQuery->where('jenis_kegiatan_id', $selectedJenisKegiatan);
            }

            $yearlyComparisonData[] = $yearlyQuery->count();
        }

        return view('admin.laporan.index', compact(
            'rekapStatus',
            'laporanJenis',
            'selectedMonth',
            'selectedYear',
            'months',
            'years',
            'rekapKewarganegaraan',
            'chartLabels',
            'chartData',
            'jenisKegiatan',
            'selectedJenisKegiatan',
            'monthlyTrendLabels',
            'monthlyTrendData',
            'yearlyComparisonLabels',
            'yearlyComparisonData'
        ));
    }
    public function getDataDetail(Request $request)
    {
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');
        $jenisKegiatanId = $request->input('jenis_kegiatan_id');

        $query = Pengajuan::with(['user', 'jenisKegiatan'])
            ->where('jenis_kegiatan_id', $jenisKegiatanId);

        if ($selectedMonth) {
            $query->whereMonth('created_at', $selectedMonth);
        }

        if ($selectedYear) {
            $query->whereYear('created_at', $selectedYear);
        }

        $data = $query->latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'nama_pemohon' => $item->nama_pemohon,
                'instansi' => $item->instansi,
                'status' => $item->status,
                'tanggal_mulai' => Carbon::parse($item->tanggal_mulai)->format('d M Y'),
                'tanggal_selesai' => Carbon::parse($item->tanggal_selesai)->format('d M Y'),
                'url' => route('admin.pengajuan.show', $item->id),
            ];
        });

        return response()->json($data);
    }
}
