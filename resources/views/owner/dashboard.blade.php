@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h4 class="mb-2">Dashboard Owner</h4>
            <p class="mb-0">Selamat datang, <strong>{{ auth()->user()->nama_lengkap }}</strong></p>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body text-center">
                    <h3>{{ $totalKendaraan }}</h3>
                    <p class="mb-0">Total Kendaraan</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body text-center">
                    <h3>{{ $totalArea }}</h3>
                    <p class="mb-0">Area Parkir</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-dark shadow-sm">
                <div class="card-body text-center">
                    <h3>{{ $totalTarif }}</h3>
                    <p class="mb-0">Jenis Tarif</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-body text-center">
                    <h3>{{ $totalUser }}</h3>
                    <p class="mb-0">Total User</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu -->
    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Menu Owner</strong>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                <a href="{{ route('owner.laporan') }}" class="list-group-item list-group-item-action">
                    📊 Laporan Parkir
                </a>

                <a href="{{ url('/area') }}" class="list-group-item list-group-item-action">
                    🅿️ Lihat Area Parkir
                </a>

                <a href="{{ url('/tarif') }}" class="list-group-item list-group-item-action">
                    💰 Lihat Tarif Parkir
                </a>

                <a href="{{ url('/kendaraan') }}" class="list-group-item list-group-item-action">
                    🚗 Lihat Data Kendaraan
                </a>

                <a href="{{ url('/log') }}" class="list-group-item list-group-item-action">
                    📜 Log Aktivitas
                </a>

                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action text-danger">
                    🚪 Logout
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
