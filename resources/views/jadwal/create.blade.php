@extends('layouts.app')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Tambah Jadwal Baru</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="pengajar_id" class="form-label">Pengajar</label>
            <select name="pengajar_id" class="form-select" required>
                <option value="">-- Pilih Pengajar --</option>
                @foreach($pengajars as $pengajar)
                    <option value="{{ $pengajar->id }}">{{ $pengajar->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="kelas_id" class="form-label">Kelas</label>
            <select name="kelas_id" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelases as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <select name="hari" class="form-select" required>
                <option value="">-- Pilih Hari --</option>
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
                    <option value="{{ $hari }}">{{ $hari }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jam" class="form-label">Jam</label>
            <select name="jam" class="form-select" required>
    <option value="">-- Pilih Jam --</option>
    <option value="16.00 - 17.30">16.00 - 17.30</option>
    <option value="18.30 - 20.00">18.30 - 20.00</option>
    <option value="19.30 - 20.30">19.30 - 20.30</option>
    <option value="20.00 - 21.00">20.00 - 21.00</option>
    <option value="21.00 - 22.30">21.00 - 22.30</option>
   </select>
        </div>

        <div class="mb-3">
            <label for="mapel" class="form-label">Mata Pelajaran</label>
            <input type="text" name="mapel" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
