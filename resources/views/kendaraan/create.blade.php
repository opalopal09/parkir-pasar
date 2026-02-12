@extends('layouts.app')

@section('content')
<div class="container">
<h4>Tambah Kendaraan</h4>

<form method="POST" action="/kendaraan">
@csrf

<input name="plat_nomor" class="form-control mb-2" placeholder="Plat Nomor">
<input name="jenis" class="form-control mb-2" placeholder="Jenis Kendaraan">
<input name="warna" class="form-control mb-2" placeholder="Warna">
<input name="pemilik" class="form-control mb-2" placeholder="Pemilik">

<button class="btn btn-success">Simpan</button>
<a href="/kendaraan" class="btn btn-secondary">Kembali</a>
</form>
</div>
@endsection
