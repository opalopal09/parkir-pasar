@extends('layouts.app')

@section('content')
<div class="container">
<h4>Data Kendaraan</h4>

<a href="/kendaraan/create" class="btn btn-primary mb-2">Tambah Kendaraan</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<table class="table table-bordered">
<tr>
    <th>No</th>
    <th>Plat Nomor</th>
    <th>Jenis</th>
    <th>Warna</th>
    <th>Pemilik</th>
    <th>Status</th>
    <th>Waktu Masuk</th>
    <th>Aksi</th>
</tr>
@foreach($kendaraans as $k)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $k->plat_nomor }}</td>
    <td>{{ $k->jenis }}</td>
    <td>{{ $k->warna }}</td>
    <td>{{ $k->pemilik }}</td>
    <td>
        @if($k->status == 'masuk')
            <span class="badge bg-success">Masuk</span>
        @else
            <span class="badge bg-secondary">Keluar</span>
        @endif
    </td>
    <td>{{ $k->created_at->format('d/m/Y H:i') }}</td>
    <td>
        @if($k->status == 'masuk')
            <a href="/kendaraan/{{ $k->id }}/exit" class="btn btn-info btn-sm">Keluar</a>
            <a href="/kendaraan/{{ $k->id }}/receipt/entry" class="btn btn-success btn-sm" target="_blank">📄 Karcis Masuk</a>
        @else
            <a href="/kendaraan/{{ $k->id }}/receipt/exit" class="btn btn-primary btn-sm" target="_blank">💰 Karcis Keluar</a>
        @endif
        <a href="/kendaraan/{{ $k->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
        <form action="/kendaraan/{{ $k->id }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</table>
</div>
@endsection
