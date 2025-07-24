{{-- Lokasi: resources/views/pengajar/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Data Pengajar')

@section('content')

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Pengajar</h5>
                <a href="{{ route('pengajar.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Tambah Pengajar
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('pengajar.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan nama..." value="{{ request('search') }}">
                            <button class="btn btn-secondary" type="submit"><i class="bi bi-search"></i> Cari</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajars as $index => $pengajar)
                            <tr>
                                <td>{{ $pengajars->firstItem() + $index }}</td>
                                <td>{{ $pengajar->nama_lengkap }}</td>
                                <td>{{ $pengajar->jenis_kelamin }}</td>
                                <td class="text-center">
                                    <a href="{{route('pengajar.edit', $pengajar->id)}}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('pengajar.destroy', $pengajar->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Anda yakin?')">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <div>
                <small>Menampilkan {{ $pengajars->firstItem() }} - {{ $pengajars->lastItem() }} dari {{ $pengajars->total() }} data</small>
            </div>
            <div>
                {{ $pengajars->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection