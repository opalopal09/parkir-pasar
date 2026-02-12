<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tarif;
use App\Models\Area;
use App\Models\Kendaraan;
use App\Models\LogAktivitas;

class OwnerController extends Controller
{
    // =======================
    // DASHBOARD OWNER
    // =======================
    public function index()
    {
        $totalUser      = User::count();
        $totalTarif     = Tarif::count();
        $totalArea      = Area::count();
        $totalKendaraan = Kendaraan::count();

        return view('owner.dashboard', compact(
            'totalUser',
            'totalTarif',
            'totalArea',
            'totalKendaraan'
        ));
    }

    // =======================
    // LAPORAN OWNER
    // =======================
    public function laporan()
    {
        $totalUser      = User::count();
        $totalTarif     = Tarif::count();
        $totalArea      = Area::count();
        $totalKendaraan = Kendaraan::count();

        // Statistik Kendaraan (Case Insensitive check if needed, but using exact match as common practice)
        $kendaraanMotor = Kendaraan::where('jenis', 'Motor')->orWhere('jenis', 'motor')->count();
        $kendaraanMobil = Kendaraan::where('jenis', 'Mobil')->orWhere('jenis', 'mobil')->count();

        // Statistik Area
        $areaAktif      = Area::where('status', 'aktif')->count();
        $areaNonaktif   = Area::where('status', 'nonaktif')->count();

        // Daftar Tarif & Log terbaru
        $tarifList      = Tarif::all();
        $logTerbaru     = LogAktivitas::latest()->limit(5)->get();

        return view('owner.laporan', compact(
            'totalUser',
            'totalTarif',
            'totalArea',
            'totalKendaraan',
            'kendaraanMotor',
            'kendaraanMobil',
            'areaAktif',
            'areaNonaktif',
            'tarifList',
            'logTerbaru'
        ));
    }
}
