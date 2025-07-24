@extends('layouts.app')

@section('title', 'Jadwal Pengajar')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Jadwal Mengajar Saya</h4>
        @if(session('pengajar_nama'))
            <span class="text-muted">Pengajar: <strong>{{ session('pengajar_nama') }}</strong></span>
        @endif
    </div>

    @if ($jadwal->isEmpty())
        <div class="alert alert-warning">Belum ada jadwal tersedia.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
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
        </div>
    @endif
</div>
@endsection
