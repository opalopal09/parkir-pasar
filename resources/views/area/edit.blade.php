@extends('layouts.app')

@section('content')
<div class="container">
<h4>Edit Area</h4>

<form method="POST" action="/area/{{ $area->id }}">
@csrf
@method('PUT')

<input name="nama_area" value="{{ $area->nama_area }}" class="form-control mb-2">
<input name="kapasitas_motor" value="{{ $area->kapasitas_motor }}" class="form-control mb-2">
<input name="kapasitas_mobil" value="{{ $area->kapasitas_mobil }}" class="form-control mb-2">

<select name="status" class="form-control mb-2">
<option {{ $area->status=='aktif'?'selected':'' }}>aktif</option>
<option {{ $area->status=='nonaktif'?'selected':'' }}>nonaktif</option>
</select>

<button class="btn btn-primary">Update</button>
</form>
</div>
@endsection
