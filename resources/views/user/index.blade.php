@extends('layouts.app')

@section('content')
<h4>Data User</h4>

@if(auth()->user()->role != 'owner')
<a href="/user/create" class="btn btn-primary mb-3">Tambah User</a>
@endif

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Role</th>
        <th>Status</th>
        @if(auth()->user()->role != 'owner')
        <th>Aksi</th>
        @endif
    </tr>

    @foreach($user as $u)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $u->nama_lengkap }}</td>
        <td>{{ $u->username }}</td>
        <td>{{ $u->role }}</td>
        <td>{{ $u->status_aktif ? 'Aktif' : 'Non Aktif' }}</td>
        @if(auth()->user()->role != 'owner')
        <td>
            <a href="/user/{{ $u->id_user }}/edit" class="btn btn-warning btn-sm">Edit</a>

            <form action="/user/{{ $u->id_user }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </td>
        @endif
    </tr>
    @endforeach
</table>
@endsection
