@extends('layouts.app')

@section('content')
<h4>{{ isset($tarif) ? 'Edit Tarif' : 'Tambah Tarif' }}</h4>

<form method="POST" action="{{ isset($tarif) ? url('/tarif/'.$tarif->id_tarif) : url('/tarif') }}">
    @csrf
    @if(isset($tarif))
        @method('PUT')
    @endif

    <div class="mb-2">
        <label>Jenis Kendaraan</label>
        <select name="jenis_kendaraan" class="form-control">
            <option value="">-- Pilih Jenis --</option>
            <option value="motor" {{ (isset($tarif) && $tarif->jenis_kendaraan == 'motor') ? 'selected' : '' }}>Motor</option>
            <option value="mobil" {{ (isset($tarif) && $tarif->jenis_kendaraan == 'mobil') ? 'selected' : '' }}>Mobil</option>
        </select>
    </div>

    <div class="mb-2">
        <label>Tarif Per Jam</label>
        <input type="number" name="tarif_per_jam" class="form-control"
        value="{{ $tarif->tarif_per_jam ?? '' }}">
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="/tarif" class="btn btn-secondary">Kembali</a>
</form>
@endsection
