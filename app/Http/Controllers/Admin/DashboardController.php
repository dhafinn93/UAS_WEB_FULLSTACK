<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kos;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalKos = Kos::count();
        $totalReview = Review::count();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalKos',
            'totalReview'
        ));
    }
}