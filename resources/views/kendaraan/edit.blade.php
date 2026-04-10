@extends('layouts.app')

@section('content')
<div class="container">
<h4>Edit Kendaraan</h4>

<form method="POST" action="/kendaraan/{{ $kendaraan->id }}">
@csrf
@method('PUT')

@if ($errors->any())
    <div class="alert alert-danger mb-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<input name="plat_nomor" value="{{ old('plat_nomor', $kendaraan->plat_nomor) }}" class="form-control mb-2" placeholder="Plat Nomor">
<input name="jenis" value="{{ old('jenis', $kendaraan->jenis) }}" class="form-control mb-2" placeholder="Jenis Kendaraan">
<input name="warna" value="{{ old('warna', $kendaraan->warna) }}" class="form-control mb-2" placeholder="Warna">
<input name="pemilik" value="{{ old('pemilik', $kendaraan->pemilik) }}" class="form-control mb-2" placeholder="Pemilik">

<button class="btn btn-primary">Update</button>
<a href="/kendaraan" class="btn btn-secondary">Kembali</a>
</form>
</div>
@endsection
