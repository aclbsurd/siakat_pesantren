@extends('layouts.app')

@section('title', 'Daftar Pengaduan')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 fw-bold">📢 Daftar Pengaduan Pengguna</h4>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Cek data --}}
    @if($pengaduan->isEmpty())
        <div class="alert alert-info">Belum ada pengaduan yang masuk.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>#</th>
                        <th>Nama Pengguna</th>
                        <th>Isi Pengaduan</th>
                        <th>Status</th>
                        <th>Tanggal Dikirim</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengaduan as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name ?? 'Tidak Diketahui' }}</td>
                            <td>{{ $item->isi_pesan }}</td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('pengaduan.update', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                        <option value="ditindaklanjuti" {{ $item->status == 'ditindaklanjuti' ? 'selected' : '' }}>✅ Ditindaklanjuti</option>
                                    </select>
                                </form>
                            </td>
                            <td class="text-center">
                                {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y H:i') : '-' }}
                            </td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('pengaduan.destroy', $item->id) }}" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus Pengaduan">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
