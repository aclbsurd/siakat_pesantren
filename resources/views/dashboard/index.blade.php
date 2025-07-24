{{-- Lokasi: resources/views/dashboard/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- Pesan Selamat Datang --}}
@auth
<div class="alert alert-primary">
    Selamat Datang, <strong>{{ $user->nama }}</strong>! Anda telah login sebagai admin.
</div>
@endauth

{{-- Kartu Statistik --}}
<div class="row">
    {{-- Kartu Jumlah Santri Aktif --}}
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-start border-primary border-4 h-100 py-2 shadow-sm">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                            Jumlah Santri (Aktif)</div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $jumlahSantri }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people-fill fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kartu Jumlah Pengajar --}}
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-start border-success border-4 h-100 py-2 shadow-sm">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-success text-uppercase mb-1">
                            Jumlah Pengajar</div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $jumlahPengajar }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person-video3 fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kartu Jumlah Kelas --}}
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-start border-info border-4 h-100 py-2 shadow-sm">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-info text-uppercase mb-1">
                            Jumlah Kelas</div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $jumlahKelas }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-door-open-fill fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <h6 class="m-0 fw-bold">Aksi Cepat</h6>
            </div>
            <div class="card-body">
                <p>Gunakan tombol di bawah ini untuk navigasi cepat ke modul utama.</p>
                <a href="{{ route('santri.index') }}" class="btn btn-primary mb-2">Lihat Data Santri</a>
                <a href="{{ route('pengajar.index') }}" class="btn btn-success mb-2">Lihat Data Pengajar</a>
                <a href="{{ route('pengaduan.index') }}" class="btn btn-warning mb-2">Lihat Pengaduan</a>
            </div>
        </div>
    </div>
</div>

@endsection
