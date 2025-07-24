{{-- Lokasi: resources/views/santri/index.blade.php (Versi Sempurna) --}}

@extends('layouts.app')

@section('title', 'Data Santri')

@section('content')

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
    <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Santri</h5>
        <div>
                {{-- Tombol Tambah --}}
                <a href="{{ route('santri.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Tambah Santri
            </a>
            <a href="{{ route('santri.cetak', ['search' => request('search')]) }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-printer"></i> Cetak Laporan
            </a>
            </div>
        </div>
        <div class="card-body">
            {{-- Form Pencarian --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('santri.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan nama atau NIS..." value="{{ request('search') }}">
                            <button class="btn btn-secondary" type="submit"><i class="bi bi-search"></i> Cari</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tabel Data --}}
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($santris as $index => $santri)
                            <tr>
                                <td>{{ $santris->firstItem() + $index }}</td>
                                <td>{{ $santri->nis }}</td>
                                <td>{{ $santri->nama_lengkap }}</td>
                                {{-- Menampilkan nama kelas, dengan fallback jika santri tidak punya kelas --}}
                                <td>{{ $santri->kelas->nama_kelas ?? 'Tanpa Kelas' }}</td>
                                <td>
                                    {{-- Badge Status Dinamis --}}
                                    @php
                                        $statusClass = '';
                                        switch ($santri->status) {
                                            case 'Aktif':
                                                $statusClass = 'bg-success';
                                                break;
                                            case 'Lulus':
                                                $statusClass = 'bg-primary';
                                                break;
                                            case 'Berhenti':
                                                $statusClass = 'bg-secondary';
                                                break;
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $santri->status }}</span>
                                </td>
                                <td class="text-center">
                                    {{-- Tombol Aksi dengan Ikon --}}
                                    <a href="{{ route('santri.edit', $santri->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('santri.destroy', $santri->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus data santri ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    Data tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            {{-- Info Jumlah Data --}}
            <div>
                <small>Menampilkan {{ $santris->firstItem() }} - {{ $santris->lastItem() }} dari {{ $santris->total() }} data</small>
            </div>
            {{-- Link Pagination --}}
            <div>
                {{ $santris->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection