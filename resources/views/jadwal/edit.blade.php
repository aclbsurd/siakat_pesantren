@extends('layouts.app')

@section('title', 'Edit Jadwal')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 fw-bold">Edit Jadwal</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Pilih Kelas --}}
        <div class="mb-3">
            <label for="kelas_id" class="form-label">Kelas</label>
            <select name="kelas_id" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelas as $item)
                    <option value="{{ $item->id }}" {{ $jadwal->kelas_id == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Pilih Pengajar --}}
        <div class="mb-3">
            <label for="pengajar_id" class="form-label">Pengajar</label>
            <select name="pengajar_id" class="form-select" required>
                <option value="">-- Pilih Pengajar --</option>
                @foreach ($pengajar as $item)
                    <option value="{{ $item->id }}" {{ $jadwal->pengajar_id == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Pilih Hari --}}
        <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <select name="hari" class="form-select" required>
                <option value="">-- Pilih Hari --</option>
                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                    <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>
                        {{ $hari }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Pilih Jam --}}
        <div class="mb-3">
            <label for="jam" class="form-label">Jam Pelajaran</label>
            <select name="jam" class="form-select" required>
                <option value="">-- Pilih Jam --</option>
                @foreach ([
                    '16.00 - 17.30',
                    '18.30 - 20.00',
                    '19.30 - 20.30',
                    '20.00 - 21.00',
                    '21.00 - 22.30',
                ] as $jam)
                    <option value="{{ $jam }}" {{ $jadwal->jam == $jam ? 'selected' : '' }}>
                        {{ $jam }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Mata Pelajaran --}}
        <div class="mb-3">
            <label for="mapel" class="form-label">Mata Pelajaran</label>
            <input type="text" name="mapel" class="form-control" value="{{ old('mapel', $jadwal->mapel) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Jadwal</button>
        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
