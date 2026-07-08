<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $kos = Kos::when($search, function ($query) use ($search) {
            $query->where('nama_kos', 'like', '%' . $search . '%');
        })->latest()->get();

        $totalKos = Kos::count();

        $totalReview = Review::where('user_id', Auth::id())->count();

        return view('user.dashboard', compact(
            'kos',
            'totalKos',
            'totalReview'
        ));
    }
}