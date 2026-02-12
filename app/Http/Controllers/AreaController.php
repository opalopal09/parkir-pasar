<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $area = Area::all();
        return view('area.index', compact('area'));
    }

    public function create()
    {
        return view('area.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required'
        ]);

        Area::create($request->all());

        return redirect()->route('area.index')->with('success', 'Area berhasil ditambahkan');
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('area.edit', compact('area'));
    }

    public function update(Request $request, $id)
    {
        $area = Area::findOrFail($id);

        $area->update($request->all());

        return redirect()->route('area.index')->with('success', 'Area berhasil diupdate');
    }

    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return redirect()->route('area.index')->with('success', 'Area berhasil dihapus');
    }
}
