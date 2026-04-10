@extends('layouts.app')

@section('content')
<div class="container">
<h4>Tambah Kendaraan</h4>

<form method="POST" action="/kendaraan">
@csrf

@if ($errors->any())
    <div class="alert alert-danger mb-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<input name="plat_nomor" class="form-control mb-2" placeholder="Plat Nomor" value="{{ old('plat_nomor') }}">
<input name="jenis" class="form-control mb-2" placeholder="Jenis Kendaraan" value="{{ old('jenis') }}">
<input name="warna" class="form-control mb-2" placeholder="Warna" value="{{ old('warna') }}">
<input name="pemilik" class="form-control mb-2" placeholder="Pemilik" value="{{ old('pemilik') }}">

<button class="btn btn-success">Simpan</button>
<a href="/kendaraan" class="btn btn-secondary">Kembali</a>
</form>
</div>
@endsection
