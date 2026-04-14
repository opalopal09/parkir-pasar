@extends('layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex align-items-center mb-4">
            <div class="bg-primary p-3 rounded-4 me-3 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
            </div>
            <div>
                <h2 class="fw-bold mb-0">Dashboard Admin</h2>
                <p class="text-muted mb-0">Kelola operasional pasar Anda dengan satu sentuhan.</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <a href="/user" class="text-decoration-none">
            <div class="card h-100 border-0 text-center p-4">
                <div class="card-body">
                    <div class="display-4 mb-3">👤</div>
                    <h5 class="fw-bold text-dark">Kelola User</h5>
                    <p class="text-muted small">Tambah, edit, atau nonaktifkan akun petugas dan owner.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="/tarif" class="text-decoration-none">
            <div class="card h-100 border-0 text-center p-4">
                <div class="card-body">
                    <div class="display-4 mb-3">💰</div>
                    <h5 class="fw-bold text-dark">Tarif Parkir</h5>
                    <p class="text-muted small">Atur tarif parkir untuk berbagai jenis kendaraan.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="/area" class="text-decoration-none">
            <div class="card h-100 border-0 text-center p-4">
                <div class="card-body">
                    <div class="display-4 mb-3">🅿️</div>
                    <h5 class="fw-bold text-dark">Area Parkir</h5>
                    <p class="text-muted small">Monitor dan atur lokasi parkir yang tersedia.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="/kendaraan" class="text-decoration-none">
            <div class="card h-100 border-0 text-center p-4">
                <div class="card-body">
                    <div class="display-4 mb-3">🚗</div>
                    <h5 class="fw-bold text-dark">Data Kendaraan</h5>
                    <p class="text-muted small">Lihat riwayat kendaraan yang masuk dan keluar.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="/log" class="text-decoration-none">
            <div class="card h-100 border-0 text-center p-4">
                <div class="card-body">
                    <div class="display-4 mb-3">📜</div>
                    <h5 class="fw-bold text-dark">Log Aktivitas</h5>
                    <p class="text-muted small">Pantau semua jejak aktivitas sistem secara real-time.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="/logout" class="text-decoration-none">
            <div class="card h-100 border-0 text-center p-4 hover-danger">
                <div class="card-body">
                    <div class="display-4 mb-3">🚪</div>
                    <h5 class="fw-bold text-danger">Keluar</h5>
                    <p class="text-muted small">Keluar dari sesi administrasi dengan aman.</p>
                </div>
            </div>
        </a>
    </div>
</div>

<style>
    .card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }
    .card:hover {
        transform: translateY(-10px);
        background: white;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .hover-danger:hover {
        background: #fff1f2 !important;
    }
</style>

<div class="row mt-5">
    <div class="col-12">
        <div class="card shadow-sm border-0 p-4">
            <h5 class="fw-bold mb-3">Transaksi Terbaru</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Plat Nomor</th>
                            <th>Jenis</th>
                            <th>Waktu Masuk</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $kendaraans = \App\Models\Kendaraan::orderBy('created_at', 'desc')->take(5)->get();
                        @endphp
                        @forelse($kendaraans as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge bg-secondary">{{ $k->plat_nomor }}</span></td>
                            <td>{{ $k->jenis }}</td>
                            <td>{{ $k->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($k->status == 'masuk')
                                    <span class="badge bg-success">Masuk</span>
                                @else
                                    <span class="badge bg-secondary">Keluar</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada transaksi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-2 text-end">
                <a href="/kendaraan" class="btn btn-sm btn-outline-primary">Lihat Semua Data</a>
            </div>
        </div>
    </div>
</div>

@endsection
