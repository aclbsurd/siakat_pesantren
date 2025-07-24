@extends('layouts.app')

@section('title', 'Jadwal Santri')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Jadwal Pelajaran</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($jadwal->count() > 0)
        <div class="table-responsive">
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
                            <td>{{ $item->hari }}</td>
                            <td>{{ $item->jam }}</td>
                           <td>{{ $item->mata_pelajaran }}</td>
                            <td>{{ $item->pengajar->nama_lengkap ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning">Belum ada jadwal tersedia untuk kelas Anda.</div>
    @endif
</div>
@endsection
