{{-- Lokasi: resources/views/santri/edit.blade.php --}}

@extends('layouts.app')

@section('title', 'Edit Data Santri')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Formulir Edit Santri</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('santri.update', $santri->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Method PUT untuk proses update --}}

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nis" class="form-label">Nomor Induk Santri (NIS)</label>
                        <input type="text" class="form-control" id="nis" name="nis" value="{{ old('nis', $santri->nis) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $santri->nama_lengkap) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Aktif" {{ old('status', $santri->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Lulus" {{ old('status', $santri->status) == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                            <option value="Berhenti" {{ old('status', $santri->status) == 'Berhenti' ? 'selected' : '' }}>Berhenti</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kelas_id" class="form-label">Kelas</label>
                        <select class="form-select" id="kelas_id" name="kelas_id">
                            <option value="">-- Tidak ada kelas --</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id', $santri->kelas_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_wali" class="form-label">Nama Wali</label>
                        <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="{{ old('nama_wali', $santri->nama_wali) }}">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="4">{{ old('alamat', $santri->alamat) }}</textarea>
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-end">
                <a href="{{ route('santri.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection