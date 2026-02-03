<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;

class DashboardController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::with(['user', 'jenisKegiatan'])->latest()->get();
        return view('admin.dashboard', compact('pengajuans'));
    }
}