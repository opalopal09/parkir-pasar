@extends('layouts.app')

@section('content')
<div class="container">
<h4>Edit Kendaraan</h4>

<form method="POST" action="/kendaraan/{{ $kendaraan->id }}">
@csrf
@method('PUT')

<input name="plat_nomor" value="{{ $kendaraan->plat_nomor }}" class="form-control mb-2" placeholder="Plat Nomor">
<input name="jenis" value="{{ $kendaraan->jenis }}" class="form-control mb-2" placeholder="Jenis Kendaraan">
<input name="warna" value="{{ $kendaraan->warna }}" class="form-control mb-2" placeholder="Warna">
<input name="pemilik" value="{{ $kendaraan->pemilik }}" class="form-control mb-2" placeholder="Pemilik">

<button class="btn btn-primary">Update</button>
<a href="/kendaraan" class="btn btn-secondary">Kembali</a>
</form>
</div>
@endsection
