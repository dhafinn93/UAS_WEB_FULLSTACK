<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Kos;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Semua Review
    public function index()
    {
        $reviews = Review::with(['user', 'kos'])->get();

        return response()->json([
            'data' => $reviews
        ]);
    }

    // Tambah Review
    public function store(Request $request)
    {
        $request->validate([
            'kos_id' => 'required|exists:kos,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required'
        ]);

        $review = Review::create([
            'user_id' => auth()->id(),
            'kos_id' => $request->kos_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar
        ]);

        return response()->json([
            'message' => 'Review berhasil ditambahkan',
            'data' => $review
        ], 201);
    }

    // Detail Review
    public function show(string $id)
    {
        $review = Review::with(['user', 'kos'])
                    ->findOrFail($id);

        return response()->json([
            'data' => $review
        ]);
    }

    // Update Review
    public function update(Request $request, string $id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'Anda tidak memiliki akses'
            ], 403);
        }

        $review->update([
            'rating' => $request->rating,
            'komentar' => $request->komentar
        ]);

        return response()->json([
            'message' => 'Review berhasil diperbarui',
            'data' => $review
        ]);
    }

    // Hapus Review
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);

        if (
            auth()->user()->role !== 'admin' &&
            $review->user_id !== auth()->id()
        ) {
            return response()->json([
                'message' => 'Anda tidak memiliki akses'
            ], 403);
        }

        $review->delete();

        return response()->json([
            'message' => 'Review berhasil dihapus'
        ]);
    }
}