@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">🚗 Proses Kendaraan Keluar</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('kendaraan.processExit', $kendaraan->id) }}" method="POST">
                        @csrf
                        
                        <h6 class="mb-3 fw-bold">Informasi Kendaraan</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Plat Nomor</label>
                                <input type="text" class="form-control" value="{{ $kendaraan->plat_nomor }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Jenis Kendaraan</label>
                                <input type="text" class="form-control" value="{{ $kendaraan->jenis }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Warna</label>
                                <input type="text" class="form-control" value="{{ $kendaraan->warna }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Pemilik</label>
                                <input type="text" class="form-control" value="{{ $kendaraan->pemilik }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small">Waktu Masuk</label>
                            <input type="text" class="form-control" value="{{ $kendaraan->created_at->format('d/m/Y H:i:s') }}" readonly>
                        </div>

                        <hr class="my-4">

                        <h6 class="mb-3 fw-bold">Informasi Parkir</h6>
                        
                        <div class="mb-3">
                            <label class="form-label">Area Parkir <span class="text-danger">*</span></label>
                            <select name="id_area" class="form-select @error('id_area') is-invalid @enderror" required>
                                <option value="">-- Pilih Area --</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->nama_area }}</option>
                                @endforeach
                            </select>
                            @error('id_area')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tarif Parkir <span class="text-danger">*</span></label>
                            <select name="id_tarif" class="form-select @error('id_tarif') is-invalid @enderror" required>
                                <option value="">-- Pilih Tarif --</option>
                                @foreach($tarifs as $tarif)
                                    <option value="{{ $tarif->id_tarif }}">
                                        {{ $tarif->jenis_kendaraan }} - Rp {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}/jam
                                    </option>
                                @endforeach
                            </select>
                            @error('id_tarif')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <small>
                                <i class="bi bi-info-circle"></i>
                                Tarif akan dihitung otomatis berdasarkan durasi parkir (pembulatan ke atas per jam).
                            </small>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Proses Keluar
                            </button>
                            <a href="/kendaraan" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
