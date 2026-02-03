<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $pengajuans = $user->pengajuans()
            ->with('jenisKegiatan')
            ->latest()
            ->get();

        return view('dashboard', compact('pengajuans'));
    }
}
