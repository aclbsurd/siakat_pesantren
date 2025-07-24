@extends('layouts.app')

@section('title', 'Jadwal Santri')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold mb-4">Jadwal Pelajaran Saya</h4>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    @if ($jadwal->isEmpty())
        <div class="alert alert-warning">Belum ada jadwal tersedia untuk kelas Anda.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Mata Pelajaran</th>
                    <th>Pengajar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $item)
                    <tr>
                        <td>{{ ucfirst($item->hari) }}</td>
                        <td>{{ $item->jam }}</td>
                        <td>{{ $item->mapel }}</td>
                        <td>{{ $item->pengajar->nama_lengkap ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
