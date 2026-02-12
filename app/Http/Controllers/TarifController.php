<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        $data = Tarif::all();
        return view('tarif.index', compact('data'));
    }

    public function create()
    {
        return view('tarif.form');
    }

    public function store(Request $r)
    {
        $r->validate([
            'jenis_kendaraan' => 'required',
            'tarif_per_jam' => 'required|numeric'
        ]);

        Tarif::create($r->all());
        return redirect('/tarif')->with('success','Data berhasil ditambah');
    }

    public function edit($id)
    {
        $tarif = Tarif::find($id);
        return view('tarif.form', compact('tarif'));
    }

    public function update(Request $r, $id)
    {
        $r->validate([
            'jenis_kendaraan' => 'required',
            'tarif_per_jam' => 'required|numeric'
        ]);

        $tarif = Tarif::find($id);
        $tarif->update($r->all());

        return redirect('/tarif')->with('success','Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Tarif::destroy($id);
        return redirect('/tarif')->with('success','Data berhasil dihapus');
    }
}
