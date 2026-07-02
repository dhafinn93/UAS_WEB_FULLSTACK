<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Kos;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Menampilkan semua review milik user
     */
    public function index()
    {
        $reviews = Review::with('kos')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.review.index', compact('reviews'));
    }

    /**
     * Form tambah review
     */
    public function create()
    {
        $kos = Kos::all();

        return view('user.review.create', compact('kos'));
    }

    /**
     * Simpan review
     */
    public function store(Request $request)
    {
        $request->validate([
            'kos_id' => 'required|exists:kos,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'kos_id' => $request->kos_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect('/user/review')
            ->with('success', 'Review berhasil ditambahkan.');
    }

    /**
     * Detail review
     */
    public function show(Review $review)
    {
        if ($review->user_id != auth()->id()) {
            abort(403);
        }

        return view('user.review.show', compact('review'));
    }

    /**
     * Form edit review
     */
    public function edit(Review $review)
    {
        if ($review->user_id != auth()->id()) {
            abort(403);
        }

        $kos = Kos::all();

        return view('user.review.edit', compact('review', 'kos'));
    }

    /**
     * Update review
     */
    public function update(Request $request, Review $review)
    {
        if ($review->user_id != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'kos_id' => 'required|exists:kos,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:1000',
        ]);

        $review->update([
            'kos_id' => $request->kos_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect('/user/review')
            ->with('success', 'Review berhasil diperbarui.');
    }

    /**
     * Hapus review
     */
    public function destroy(Review $review)
    {
        if ($review->user_id != auth()->id()) {
            abort(403);
        }

        $review->delete();

        return redirect('/user/review')
            ->with('success', 'Review berhasil dihapus.');
    }
}