<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Pengajuan::count();
        $pending = Pengajuan::where('status', 'menunggu')->count();
        $approved = Pengajuan::where('status', 'disetujui')->count();
        $scheduled = Pengajuan::where('status', 'dijadwalkan presentasi')->count();

        $recentActivity = Pengajuan::with(['user', 'jenisKegiatan'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('total', 'pending', 'approved', 'scheduled', 'recentActivity'));
    }
}