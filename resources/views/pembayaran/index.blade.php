@extends('layouts.app')

@section('title', 'Riwayat Keuangan')

@section('content')
    {{-- Notifikasi --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Riwayat Transaksi Pembayaran</h5>
                <a href="{{ route('pembayaran.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Input Pembayaran
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('pembayaran.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari nama santri..." value="{{ request('search') }}">
                            <button class="btn btn-secondary" type="submit"><i class="bi bi-search"></i> Cari</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Santri</th>
                            <th>Jenis Pembayaran</th>
                            <th>Jumlah</th>
                            <th>Diterima Oleh</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pembayarans as $bayar)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->isoFormat('D MMMM Y') }}</td>
                                <td>{{ $bayar->santri->nama_lengkap ?? 'Santri Dihapus' }}</td>
                                <td>{{ $bayar->jenis_pembayaran }} {{ $bayar->bulan_pembayaran ? '('.$bayar->bulan_pembayaran.')' : '' }}</td>
                                <td>Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                                <td>{{ $bayar->user->nama ?? 'N/A' }}</td>
                                <td class="text-center">
                                    {{-- Tombol Cetak Kuitansi --}}
                                    <a href="{{ route('pembayaran.cetak', $bayar->id) }}" target="_blank" class="btn btn-info btn-sm" title="Cetak Kuitansi">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                    
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('pembayaran.edit', $bayar->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- Form untuk Tombol Hapus --}}
                                    <form action="{{ route('pembayaran.destroy', $bayar->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus data pembayaran ini?')">
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
                                <td colspan="6" class="text-center">Belum ada riwayat transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <div>
                <small>Menampilkan {{ $pembayarans->firstItem() }} - {{ $pembayarans->lastItem() }} dari {{ $pembayarans->total() }} data</small>
            </div>
            <div>
                {{ $pembayarans->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection