@extends('layouts.app')

@section('title', 'Jadwal Mengajar')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold mb-4">Jadwal Mengajar Saya</h4>
    @if ($jadwal->isEmpty())
        <div class="alert alert-warning">Anda belum memiliki jadwal mengajar.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Mata Pelajaran</th>
                    <th>Kelas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $item)
                    <tr>
                        <td>{{ $item->hari }}</td>
                        <td>{{ $item->jam }}</td>
                        <td>{{ $item->mapel }}</td>
                        <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
