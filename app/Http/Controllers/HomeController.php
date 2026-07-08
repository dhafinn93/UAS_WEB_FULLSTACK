<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kos;

class HomeController extends Controller
{
    // Halaman Home
    public function index(Request $request)
    {
        $query = Kos::query();

        if ($request->filled('search')) {

        $query->where('nama_kos', 'like', '%' . $request->search . '%');

    }

    $kos = $query->get();

    return view('home', compact('kos'));
    }

    // Detail Kos
    public function show($id)
    {
        $kos = Kos::with(['reviews.user'])->findOrFail($id);

        return view('detail_kos', compact('kos'));
    }
}
