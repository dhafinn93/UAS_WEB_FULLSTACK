<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $review = Review::where(
            'user_id',
            auth()->id()
        )->count();

        return view('user.dashboard', compact('review'));
    }
}