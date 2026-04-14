@extends('layouts.app')

@section('content')
<h4>Data Tarif Parkir</h4>

@if(auth()->user()->role != 'owner')
<a href="/tarif/create" class="btn btn-primary mb-2">Tambah Tarif</a>
@endif

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Jenis Kendaraan</th>
        <th>Tarif / Jam</th>
        @if(auth()->user()->role != 'owner')
        <th>Aksi</th>
        @endif
    </tr>
    @foreach($data as $i => $d)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $d->jenis_kendaraan }}</td>
        <td>{{ $d->tarif_per_jam }}</td>
        @if(auth()->user()->role != 'owner')
        <td>
            <a href="/tarif/{{ $d->id_tarif }}/edit" class="btn btn-warning btn-sm">Edit</a>
            <form action="/tarif/{{ $d->id_tarif }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</button>
            </form>
        </td>
        @endif
    </tr>
    @endforeach
</table>
@endsection
