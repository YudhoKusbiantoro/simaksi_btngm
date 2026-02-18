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
        // Default only for initial load, otherwise allow null/empty
        $selectedMonth = $request->has('month') ? $request->input('month') : now()->month;
        $selectedYear = $request->has('year') ? $request->input('year') : now()->year;
        $startYear = $request->input('start_year');
        $endYear = $request->input('end_year');
        $selectedJenisKegiatan = $request->input('jenis_kegiatan_id');

        $query = Pengajuan::query();

        // Month Filter
        if ($selectedMonth) {
            $query->whereMonth('created_at', $selectedMonth);
        }

        // Year Filter Logic (Single Year or Range)
        if ($selectedYear && $selectedYear !== 'all') {
            $query->whereYear('created_at', $selectedYear);
        } elseif ($startYear && $endYear) {
            $query->whereRaw('YEAR(created_at) BETWEEN ? AND ?', [$startYear, $endYear]);
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

        if (!in_array(now()->year, $years)) {
            array_unshift($years, now()->year);
        }

        // Monthly Trend Data
        $monthlyTrendLabels = [];
        $monthlyTrendData = [];

        // If viewing multiple years or all time, monthly trend might show average or aggregate per month name
        // For simplicity, we show monthly trend for THE selected year, or THE selected range if narrow, 
        // but here we just keep it relative to the context.
        $trendYear = ($selectedYear && $selectedYear !== 'all') ? $selectedYear : now()->year;

        for ($i = 1; $i <= 12; $i++) {
            $monthlyTrendLabels[] = $months[$i];
            $monthlyQuery = Pengajuan::whereMonth('created_at', $i);

            if ($selectedYear && $selectedYear !== 'all') {
                $monthlyQuery->whereYear('created_at', $selectedYear);
            } elseif ($startYear && $endYear) {
                $monthlyQuery->whereRaw('YEAR(created_at) BETWEEN ? AND ?', [$startYear, $endYear]);
            } else {
                // All time aggregate by month
            }

            if ($selectedJenisKegiatan) {
                $monthlyQuery->where('jenis_kegiatan_id', $selectedJenisKegiatan);
            }

            $monthlyTrendData[] = $monthlyQuery->count();
        }

        // Yearly Comparison Data
        $yearlyComparisonLabels = [];
        $yearlyComparisonData = [];

        // If range is selected, show years in range. Otherwise show last 5 years.
        if ($startYear && $endYear) {
            $comparisonYears = range($startYear, $endYear);
        } else {
            $comparisonYears = array_reverse(array_slice($years, 0, 5));
        }

        foreach ($comparisonYears as $year) {
            $yearlyComparisonLabels[] = (string) $year;
            $yearlyQuery = Pengajuan::whereYear('created_at', $year);

            if ($selectedMonth) {
                $yearlyQuery->whereMonth('created_at', $selectedMonth);
            }

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
            'startYear',
            'endYear',
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
        $startYear = $request->input('start_year');
        $endYear = $request->input('end_year');
        $jenisKegiatanId = $request->input('jenis_kegiatan_id');

        $query = Pengajuan::with(['user', 'jenisKegiatan'])
            ->where('jenis_kegiatan_id', $jenisKegiatanId);

        if ($selectedMonth) {
            $query->whereMonth('created_at', $selectedMonth);
        }

        if ($selectedYear && $selectedYear !== 'all') {
            $query->whereYear('created_at', $selectedYear);
        } elseif ($startYear && $endYear) {
            $query->whereRaw('YEAR(created_at) BETWEEN ? AND ?', [$startYear, $endYear]);
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
    public function export(Request $request)
    {
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');
        $startYear = $request->input('start_year');
        $endYear = $request->input('end_year');
        $selectedJenisKegiatan = $request->input('jenis_kegiatan_id');

        $query = Pengajuan::with(['jenisKegiatan', 'user']);

        // Month Filter
        if ($selectedMonth) {
            $query->whereMonth('created_at', $selectedMonth);
        }

        // Year Filter Logic
        if ($selectedYear && $selectedYear !== 'all') {
            $query->whereYear('created_at', $selectedYear);
        } elseif ($startYear && $endYear) {
            $query->whereRaw('YEAR(created_at) BETWEEN ? AND ?', [$startYear, $endYear]);
        }

        if ($selectedJenisKegiatan) {
            $query->where('jenis_kegiatan_id', $selectedJenisKegiatan);
        }

        // EXCLUDE "Upload PDF" or similar logic
        // Assuming "Upload PDF" is a specific activity type name we want to exclude
        $query->whereDoesntHave('jenisKegiatan', function ($q) {
            $q->where('nama', 'LIKE', '%Upload PDF%');
        });

        $pengajuans = $query->latest()->get();

        $filename = 'Laporan_SIMAKSI_' . date('Y-m-d_H-i-s') . '.xls';

        return response(view('admin.laporan.excel', compact('pengajuans')))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
