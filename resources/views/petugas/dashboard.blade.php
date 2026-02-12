@extends('layouts.app')

@section('content')
<div class="row g-4">
    <!-- Sidebar / Quick links -->
    <div class="col-lg-3">
        <div class="card border-0 shadow-sm h-100 overflow-hidden">
            <div class="card-header bg-primary text-white border-0 py-3">
                <h6 class="mb-0 fw-bold">Menu Petugas</h6>
            </div>
            <div class="list-group list-group-flush">
                <a href="/kendaraan/create" class="list-group-item list-group-item-action py-3 border-0">
                    <span class="me-2">📝</span> Input Kendaraan
                </a>
                <a href="/kendaraan" class="list-group-item list-group-item-action py-3 border-0">
                    <span class="me-2">🚗</span> Daftar Kendaraan
                </a>
                <a href="/area" class="list-group-item list-group-item-action py-3 border-0">
                    <span class="me-2">🅿️</span> Cek Area Parkir
                </a>
                <a href="/tarif" class="list-group-item list-group-item-action py-3 border-0">
                    <span class="me-2">💰</span> Cek Tarif
                </a>
                <a href="/log" class="list-group-item list-group-item-action py-3 border-0">
                    <span class="me-2">📜</span> Log Aktivitas
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="col-lg-9">
        <div class="d-flex align-items-center mb-4">
            <div class="bg-primary-subtle p-3 rounded-4 me-3">
                <span class="fs-2">👋</span>
            </div>
            <div>
                <h4 class="fw-bold mb-0">Selamat Datang, {{ auth()->user()->nama_lengkap }}</h4>
                <p class="text-muted mb-0">Monitor operasional parkir pasar hari ini.</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 bg-primary text-white shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 opacity-75">Total Kendaraan</h6>
                            <span class="fs-4">🚗</span>
                        </div>
                        <h2 class="display-6 fw-bold mb-0">{{ $totalKendaraan }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 bg-success text-white shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 opacity-75">Total Area</h6>
                            <span class="fs-4">🅿️</span>
                        </div>
                        <h2 class="display-6 fw-bold mb-0">{{ $totalArea }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 bg-warning text-dark shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 opacity-75">Jenis Tarif</h6>
                            <span class="fs-4">💰</span>
                        </div>
                        <h2 class="display-6 fw-bold mb-0">{{ $totalTarif }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Logs Activity -->
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">📜 Log Aktivitas Terbaru</h6>
                <a href="/log" class="btn btn-sm btn-light text-primary fw-bold">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">User</th>
                            <th>Aksi</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logTerbaru as $log)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm rounded-circle bg-primary-subtle p-2 me-2 text-center" style="width: 32px; height: 32px; line-height: 16px;">
                                        👤
                                    </div>
                                    <span class="small fw-semibold">{{ $log->user }}</span>
                                </div>
                            </td>
                            <td><span class="badge bg-primary-subtle text-primary border-primary-subtle">{{ $log->aksi }}</span></td>
                            <td class="text-muted small">{{ $log->keterangan }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5">
                                <p class="text-muted mb-0">Belum ada aktivitas hari ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .list-group-item {
        transition: all 0.2s ease;
    }
    .list-group-item:hover {
        background-color: var(--background);
        padding-left: 2rem !important;
        color: var(--primary) !important;
    }
    .card-header {
        border-bottom: 0;
    }
    .table thead th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 700;
        color: var(--secondary);
    }
</style>
@endsection
