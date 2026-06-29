<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Kos;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        Review::create([
            'user_id'=>auth()->id(),
            'kos_id'=>$request->kos_id,
            'rating'=>$request->rating,
            'komentar'=>$request->komentar
        ]);

        return back()->with(
            'success',
            'Review berhasil'
        );
    }

    public function index()
    {
        $reviews = Review::with('kos')
            ->where(
                'user_id',
                auth()->id()
            )
            ->latest()
            ->get();

        return view(
            'user.reviews',
            compact('reviews')
        );
    }
}