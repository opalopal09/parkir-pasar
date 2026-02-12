<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Area;
use App\Models\Tarif;
use App\Models\User;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $totalKendaraan = Kendaraan::count();
        $totalArea = Area::count();
        $totalTarif = Tarif::count();
        $totalUser = User::count();
        
        // Data kendaraan per jenis
        $kendaraanMotor = Kendaraan::where('jenis', 'motor')->count();
        $kendaraanMobil = Kendaraan::where('jenis', 'mobil')->count();
        
        // Data area aktif
        $areaAktif = Area::where('status', 'aktif')->count();
        $areaNonaktif = Area::where('status', 'nonaktif')->count();
        
        // Log aktivitas terbaru
        $logTerbaru = LogAktivitas::orderBy('created_at', 'desc')->take(10)->get();
        
        // Data tarif
        $tarifList = Tarif::all();
        
        return view('owner.laporan', compact(
            'totalKendaraan',
            'totalArea', 
            'totalTarif',
            'totalUser',
            'kendaraanMotor',
            'kendaraanMobil',
            'areaAktif',
            'areaNonaktif',
            'logTerbaru',
            'tarifList'
        ));
    }
}
