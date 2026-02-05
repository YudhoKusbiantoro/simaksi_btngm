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

        // Laporan per Jenis Kegiatan (OVERALL - for Pie Chart)
        $laporanJenisOverall = $jenisKegiatan->map(function ($jenis) {
            return [
                'nama' => $jenis->nama,
                'total' => Pengajuan::where('jenis_kegiatan_id', $jenis->id)->count(),
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

        // Monthly Trend Data (for selected year)
        $monthlyTrendLabels = [];
        $monthlyTrendData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyTrendLabels[] = $months[$i];
            $count = Pengajuan::whereYear('created_at', $selectedYear)
                ->whereMonth('created_at', $i)
                ->count();
            $monthlyTrendData[] = $count;
        }

        // Yearly Comparison Data (last 5 years or available years)
        $yearlyComparisonLabels = [];
        $yearlyComparisonData = [];
        $availableYears = array_slice($years, 0, 5); // Get up to 5 most recent years
        foreach ($availableYears as $year) {
            $yearlyComparisonLabels[] = (string) $year;
            $count = Pengajuan::whereYear('created_at', $year)->count();
            $yearlyComparisonData[] = $count;
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
            'laporanJenisOverall',
            'jenisKegiatan',
            'selectedJenisKegiatan',
            'monthlyTrendLabels',
            'monthlyTrendData',
            'yearlyComparisonLabels',
            'yearlyComparisonData'
        ));
    }
}
