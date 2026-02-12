@extends('layouts.app')

@section('content')
<h4>{{ isset($user) ? 'Edit' : 'Tambah' }} User</h4>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ isset($user) ? '/user/'.$user->id_user : '/user' }}">
    @csrf
    @if(isset($user))
        @method('PUT')
    @endif

    <input type="text" name="nama_lengkap" class="form-control mb-2" placeholder="Nama" required
        value="{{ $user->nama_lengkap ?? '' }}">

    <input type="text" name="username" class="form-control mb-2" placeholder="Username" required
        value="{{ $user->username ?? '' }}">

    <input type="password" name="password" class="form-control mb-2" placeholder="Password {{ isset($user) ? '(kosongkan jika tidak ingin mengubah)' : '' }}" {{ !isset($user) ? 'required' : '' }}>

    <select name="role" class="form-control mb-2" required>
        <option value="">-- Pilih Role --</option>
        <option value="admin" {{ (isset($user)&&$user->role=='admin')?'selected':'' }}>Admin</option>
        <option value="petugas" {{ (isset($user)&&$user->role=='petugas')?'selected':'' }}>Petugas</option>
        <option value="owner" {{ (isset($user)&&$user->role=='owner')?'selected':'' }}>Owner</option>
    </select>

    <select name="status_aktif" class="form-control mb-3" required>
        <option value="1" {{ (isset($user)&&$user->status_aktif) ? 'selected' : '' }}>Aktif</option>
        <option value="0" {{ (isset($user)&&!$user->status_aktif) ? 'selected' : '' }}>Non Aktif</option>
    </select>

    <button class="btn btn-success">Simpan</button>
    <a href="/user" class="btn btn-secondary">Kembali</a>
</form>
@endsection
