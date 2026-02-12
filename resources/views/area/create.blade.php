@extends('layouts.app')

@section('content')
<div class="container">
<h4>Tambah Area</h4>

<form method="POST" action="/area">
@csrf

<input name="nama_area" class="form-control mb-2" placeholder="Nama Area">
<input name="kapasitas_motor" class="form-control mb-2" placeholder="Kapasitas Motor">
<input name="kapasitas_mobil" class="form-control mb-2" placeholder="Kapasitas Mobil">

<select name="status" class="form-control mb-2">
<option value="aktif">Aktif</option>
<option value="nonaktif">Non Aktif</option>
</select>

<button class="btn btn-success">Simpan</button>
</form>
</div>
@endsection
