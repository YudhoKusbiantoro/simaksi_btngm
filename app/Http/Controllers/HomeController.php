<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function harga()
    {
        $settings = \App\Models\Setting::where('key', 'like', 'harga_%')->get()->pluck('value', 'key');
        return view('harga', compact('settings'));
    }
}