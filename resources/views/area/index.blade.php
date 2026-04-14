@extends('layouts.app')

@section('content')
<div class="container">
<h4>Data Area Parkir</h4>

@if(auth()->user()->role != 'owner')
<a href="/area/create" class="btn btn-primary mb-2">Tambah Area</a>
@endif

<table class="table table-bordered">
<tr>
<th>No</th>
<th>Nama Area</th>
<th>Motor</th>
<th>Mobil</th>
<th>Status</th>
@if(auth()->user()->role != 'owner')
<th>Aksi</th>
@endif
</tr>

@foreach($area as $a)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $a->nama_area }}</td>
<td>{{ $a->kapasitas_motor }}</td>
<td>{{ $a->kapasitas_mobil }}</td>
<td>{{ $a->status }}</td>
@if(auth()->user()->role != 'owner')
<td>
<a href="/area/{{ $a->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
<form action="/area/{{ $a->id }}" method="POST" style="display:inline">
@csrf
@method('DELETE')
<button class="btn btn-danger btn-sm">Hapus</button>
</form>
</td>
@endif
</tr>
@endforeach
</table>
</div>
@endsection
