<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use App\Models\Tarif;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        $totalKendaraan = Kendaraan::count();
        $totalArea      = Area::count();
        $totalTarif     = Tarif::count();
        $logTerbaru     = LogAktivitas::latest()->limit(5)->get();

        return view('petugas.dashboard', compact(
            'totalKendaraan',
            'totalArea',
            'totalTarif',
            'logTerbaru'
        ));
    }
}
