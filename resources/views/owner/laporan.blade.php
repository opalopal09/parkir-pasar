@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">📊 Laporan Parkir</h4>

    <!-- Statistik Utama -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h3>{{ $totalKendaraan }}</h3>
                    <p class="mb-0">Total Kendaraan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h3>{{ $totalArea }}</h3>
                    <p class="mb-0">Total Area</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body text-center">
                    <h3>{{ $totalTarif }}</h3>
                    <p class="mb-0">Jenis Tarif</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h3>{{ $totalUser }}</h3>
                    <p class="mb-0">Total User</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Statistik Kendaraan -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    🚗 Statistik Kendaraan
                </div>
                <div class="card-body">
                    <table class="table table-bordered mb-0">
                        <tr>
                            <td>Motor</td>
                            <td><span class="badge bg-primary">{{ $kendaraanMotor }}</span></td>
                        </tr>
                        <tr>
                            <td>Mobil</td>
                            <td><span class="badge bg-success">{{ $kendaraanMobil }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Statistik Area -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    🅿️ Statistik Area
                </div>
                <div class="card-body">
                    <table class="table table-bordered mb-0">
                        <tr>
                            <td>Area Aktif</td>
                            <td><span class="badge bg-success">{{ $areaAktif }}</span></td>
                        </tr>
                        <tr>
                            <td>Area Non-Aktif</td>
                            <td><span class="badge bg-danger">{{ $areaNonaktif }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Tarif -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            💰 Daftar Tarif Parkir
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tr>
                    <th>Jenis Kendaraan</th>
                    <th>Tarif / Jam</th>
                </tr>
                @foreach($tarifList as $tarif)
                <tr>
                    <td>{{ ucfirst($tarif->jenis_kendaraan) }}</td>
                    <td>Rp {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    <!-- Log Aktivitas Terbaru -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            📜 Log Aktivitas Terbaru
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tr>
                    <th>User</th>
                    <th>Aksi</th>
                    <th>Keterangan</th>
                    <th>Waktu</th>
                </tr>
                @forelse($logTerbaru as $log)
                <tr>
                    <td>{{ $log->user }}</td>
                    <td>{{ $log->aksi }}</td>
                    <td>{{ $log->keterangan }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada log aktivitas</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>

    <a href="/owner/dashboard" class="btn btn-secondary">← Kembali ke Dashboard</a>
</div>
@endsection
