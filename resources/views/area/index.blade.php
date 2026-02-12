@extends('layouts.app')

@section('content')
<div class="container">
<h4>Data Area Parkir</h4>

<a href="/area/create" class="btn btn-primary mb-2">Tambah Area</a>

<table class="table table-bordered">
<tr>
<th>No</th>
<th>Nama Area</th>
<th>Motor</th>
<th>Mobil</th>
<th>Status</th>
<th>Aksi</th>
</tr>

@foreach($area as $a)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $a->nama_area }}</td>
<td>{{ $a->kapasitas_motor }}</td>
<td>{{ $a->kapasitas_mobil }}</td>
<td>{{ $a->status }}</td>
<td>
<a href="/area/{{ $a->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
<form action="/area/{{ $a->id }}" method="POST" style="display:inline">
@csrf
@method('DELETE')
<button class="btn btn-danger btn-sm">Hapus</button>
</form>
</td>
</tr>
@endforeach
</table>
</div>
@endsection
