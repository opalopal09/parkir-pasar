@extends('layouts.app')

@section('content')
<div class="container">
<h4>Log Aktivitas</h4>

<table class="table table-bordered">
<tr>
    <th>No</th>
    <th>User</th>
    <th>Aksi</th>
    <th>Keterangan</th>
    <th>Waktu</th>
</tr>

@foreach($logs as $log)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $log->user }}</td>
    <td>{{ $log->aksi }}</td>
    <td>{{ $log->keterangan }}</td>
    <td>{{ $log->created_at }}</td>
</tr>
@endforeach
</table>
</div>
@endsection
