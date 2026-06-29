<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kos;

class HomeController extends Controller
{
    // Halaman Home
    public function index()
    {
        $kos = Kos::all();

        return view('home', compact('kos'));
    }

    // Detail Kos
    public function show($id)
    {
        $kos = Kos::with(['reviews.user'])->findOrFail($id);

        return view('detail-kos', compact('kos'));
    }
}
