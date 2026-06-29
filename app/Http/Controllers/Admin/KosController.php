<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KosController extends Controller
{
    public function index()
    {
        $kos = Kos::all();

        return view(
            'admin.kos.index',
            compact('kos')
        );
    }

    public function create()
    {
        return view('admin.kos.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if($request->hasFile('foto_kos'))
        {
            $data['foto_kos'] = $request
                ->file('foto_kos')
                ->store('kos','public');
        }

        Kos::create($data);

        return redirect('/admin/kos');
    }

    public function edit($id)
    {
        $kos = Kos::findOrFail($id);

        return view(
            'admin.kos.edit',
            compact('kos')
        );
    }

    public function update(Request $request,$id)
    {
        $kos = Kos::findOrFail($id);

        $data = $request->all();

        if($request->hasFile('foto_kos'))
        {
            if($kos->foto_kos)
            {
                Storage::disk('public')
                    ->delete($kos->foto_kos);
            }

            $data['foto_kos']=$request
                ->file('foto_kos')
                ->store('kos','public');
        }

        $kos->update($data);

        return redirect('/admin/kos');
    }

    public function destroy($id)
    {
        $kos = Kos::findOrFail($id);

        if($kos->foto_kos)
        {
            Storage::disk('public')
                ->delete($kos->foto_kos);
        }

        $kos->delete();

        return redirect('/admin/kos');
    }
}