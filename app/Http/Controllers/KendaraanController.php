<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use App\Models\Area;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::with(['area', 'tarif'])->orderBy('created_at', 'desc')->get();
        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor' => [
                'required',
                'regex:/^[A-Z]{1,2}\s?\d{1,4}\s?[A-Z]{1,3}$/i',
                function ($attribute, $value, $fail) {
                    $exists = Kendaraan::where('plat_nomor', $value)
                        ->where('status', 'masuk')
                        ->exists();
                    if ($exists) {
                        $fail('Plat nomor ini sudah terdaftar dan masih parkir.');
                    }
                },
            ],
            'jenis'      => 'required',
            'warna'      => 'required',
            'pemilik'    => 'required',
        ], [
            'plat_nomor.required' => 'Plat nomor wajib diisi',
            'plat_nomor.regex' => 'Format plat nomor tidak valid. Contoh: B 1234 ABC atau D 567 EF',
        ]);

        $kendaraan = Kendaraan::create([
            'plat_nomor' => $request->plat_nomor,
            'jenis' => $request->jenis,
            'warna' => $request->warna,
            'pemilik' => $request->pemilik,
            'status' => 'masuk'
        ]);

        // LOG
        LogAktivitas::create([
            'user' => Auth::user()->username,
            'aksi' => 'Tambah Kendaraan',
            'keterangan' => $kendaraan->plat_nomor
        ]);

        return redirect('/kendaraan')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'plat_nomor' => [
                'required',
                'regex:/^[A-Z]{1,2}\s?\d{1,4}\s?[A-Z]{1,3}$/i',
                function ($attribute, $value, $fail) use ($id) {
                    $exists = Kendaraan::where('plat_nomor', $value)
                        ->where('status', 'masuk')
                        ->where('id', '!=', $id)
                        ->exists();
                    if ($exists) {
                        $fail('Plat nomor ini sudah terdaftar dan masih parkir.');
                    }
                },
            ],
            'jenis'      => 'required',
            'warna'      => 'required',
            'pemilik'    => 'required',
        ], [
            'plat_nomor.required' => 'Plat nomor wajib diisi',
            'plat_nomor.regex' => 'Format plat nomor tidak valid. Contoh: B 1234 ABC atau D 567 EF',
        ]);

        $kendaraan = Kendaraan::findOrFail($id);

        $kendaraan->update($request->only([
            'plat_nomor',
            'jenis',
            'warna',
            'pemilik'
        ]));

        // LOG
        LogAktivitas::create([
            'user' => Auth::user()->username,
            'aksi' => 'Update Kendaraan',
            'keterangan' => $kendaraan->plat_nomor
        ]);

        return redirect('/kendaraan')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        // LOG
        LogAktivitas::create([
            'user' => Auth::user()->username,
            'aksi' => 'Hapus Kendaraan',
            'keterangan' => $kendaraan->plat_nomor
        ]);

        $kendaraan->delete();

        return redirect('/kendaraan')->with('success', 'Data berhasil dihapus');
    }

    // Show exit form
    public function exitForm($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $areas = Area::all();
        $tarifs = Tarif::all();
        
        return view('kendaraan.exit', compact('kendaraan', 'areas', 'tarifs'));
    }

    // Process vehicle exit
    public function processExit(Request $request, $id)
    {
        $request->validate([
            'id_area' => 'required',
            'id_tarif' => 'required',
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $tarif = Tarif::findOrFail($request->id_tarif);

        // Calculate parking duration
        $waktuMasuk = Carbon::parse($kendaraan->created_at);
        $waktuKeluar = Carbon::now();
        $durasiMenit = $waktuMasuk->diffInMinutes($waktuKeluar);
        $durasiJam = (int) ceil($durasiMenit / 60);
        
        // Minimum 1 hour
        if ($durasiJam < 1) {
            $durasiJam = 1;
        }

        // Calculate total fee
        $totalBiaya = $durasiJam * $tarif->tarif_per_jam;

        // Update vehicle
        $kendaraan->update([
            'id_area' => $request->id_area,
            'id_tarif' => $request->id_tarif,
            'waktu_keluar' => $waktuKeluar,
            'total_biaya' => $totalBiaya,
            'status' => 'keluar'
        ]);

        // Log activity
        LogAktivitas::create([
            'user' => Auth::user()->username,
            'aksi' => 'Kendaraan Keluar',
            'keterangan' => $kendaraan->plat_nomor . ' - Rp ' . number_format($totalBiaya, 0, ',', '.')
        ]);

        return redirect()->route('kendaraan.receipt.exit', $id)->with('success', 'Kendaraan berhasil keluar');
    }

    // Print entry receipt (Karcis Masuk) - PDF
    public function printEntryReceipt($id)
    {
        $kendaraan = Kendaraan::with(['area', 'tarif'])->findOrFail($id);
        
        if ($kendaraan->status !== 'masuk') {
            return redirect('/kendaraan')->with('error', 'Kendaraan sudah keluar');
        }

        $pdf = Pdf::loadView('kendaraan.pdf.entry', compact('kendaraan'));
        $pdf->setPaper('a5', 'portrait');
        
        return $pdf->stream('karcis-masuk-' . $kendaraan->plat_nomor . '.pdf');
    }

    // Print exit receipt (Karcis Keluar dengan Biaya) - PDF
    public function printExitReceipt($id)
    {
        $kendaraan = Kendaraan::with(['area', 'tarif'])->findOrFail($id);
        
        if ($kendaraan->status !== 'keluar') {
            return redirect('/kendaraan')->with('error', 'Kendaraan belum keluar');
        }

        // Calculate duration for display
        $waktuMasuk = Carbon::parse($kendaraan->created_at);
        $waktuKeluar = Carbon::parse($kendaraan->waktu_keluar);
        $durasiMenit = $waktuMasuk->diffInMinutes($waktuKeluar);
        $durasiJam = (int) ceil($durasiMenit / 60);
        
        // Minimum 1 jam
        if ($durasiJam < 1) {
            $durasiJam = 1;
        }

        $pdf = Pdf::loadView('kendaraan.pdf.exit', compact('kendaraan', 'durasiJam'));
        $pdf->setPaper('a5', 'portrait');
        
        return $pdf->stream('karcis-keluar-' . $kendaraan->plat_nomor . '.pdf');
    }
}
