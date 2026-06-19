<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Kos;

class KosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kos::all()->map(function ($kos) {

        $kos->foto_url = $kos->foto_kos
            ? asset('storage/'.$kos->foto_kos)
            : null;

        return $kos;
    });
    
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kos' => 'required',
            'alamat' => 'required',
            'fasilitas' => 'required',
            'harga' => 'required|numeric',
            'foto_kos' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $foto = null;

        if ($request->hasFile('foto_kos')) {
            $foto = $request->file('foto_kos')
                        ->store('kos', 'public');
        }

         $kos = Kos::create([
            'nama_kos' => $request->nama_kos,
            'alamat' => $request->alamat,
            'fasilitas' => $request->fasilitas,
            'harga' => $request->harga,
            'foto' => $foto
        ]);

        return response()->json([
            'message' => 'Kos berhasil ditambahkan',
            'data' => $kos
        ], 201);
    }

    /**
     * Display the specified resource.
     */
   // Detail kos
    public function show(string $id)
    {
        $kos = Kos::findOrFail($id);

        return response()->json([
            'data' => $kos
        ]);
    }

    // Update kos
    public function update(Request $request, string $id)
    {
        $kos = Kos::findOrFail($id);

        if ($request->hasFile('foto_kos')) {
            if ($kos->foto_kos) {
                Storage::disk('public')
                    ->delete($kos->foto_kos);
            }

            $foto = $request->file('foto_kos')
                            ->store('kos', 'public');
            $kos->foto_kos = $foto;
        }

        $kos->nama_kos = $request->nama_kos ?? $kos->nama_kos;
        $kos->alamat = $request->alamat ?? $kos->alamat;
        $kos->fasilitas = $request->fasilitas ?? $kos->fasilitas;
        $kos->harga = $request->harga ?? $kos->harga;

        $kos->save();

        return response()->json([
            'message' => 'Kos berhasil diperbarui',
            'data' => $kos
        ]);
    }

    // Hapus kos
    public function destroy(string $id)
    {
        $kos = Kos::findOrFail($id);

        if ($kos->foto_kos) {

            Storage::disk('public')
                ->delete($kos->foto_kos);
        }

        $kos->delete();

        return response()->json([
            'message' => 'Kos berhasil dihapus'
        ]);
    }
}
