@extends('layouts.app')

@section('title', 'Input Pembayaran Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Formulir Input Pembayaran</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pembayaran.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="santri_id" class="form-label">Pilih Santri</label>
                                <select class="form-select @error('santri_id') is-invalid @enderror" id="santri_id" name="santri_id" required>
                                    <option value="" selected disabled>-- Cari dan Pilih Santri --</option>
                                    @foreach ($santris as $santri)
                                        <option value="{{ $santri->id }}" {{ old('santri_id') == $santri->id ? 'selected' : '' }}>
                                            {{ $santri->nis }} - {{ $santri->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('santri_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                                <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror" id="tanggal_bayar" name="tanggal_bayar" value="{{ old('tanggal_bayar', date('Y-m-d')) }}" required>
                                @error('tanggal_bayar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                                <select class="form-select @error('jenis_pembayaran') is-invalid @enderror" id="jenis_pembayaran" name="jenis_pembayaran" required>
                                    <option value="SPP" {{ old('jenis_pembayaran') == 'SPP' ? 'selected' : '' }}>SPP</option>
                                    <option value="Ujian" {{ old('jenis_pembayaran') == 'Ujian' ? 'selected' : '' }}>Ujian</option>
                                    <option value="Pembangunan" {{ old('jenis_pembayaran') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                                    <option value="Lainnya" {{ old('jenis_pembayaran') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('jenis_pembayaran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6" id="bulan-pembayaran-wrapper">
                            <div class="mb-3">
                                <label for="bulan_pembayaran" class="form-label">Untuk Bulan & Tahun</label>
                                <input type="text" class="form-control" id="bulan_pembayaran" name="bulan_pembayaran" placeholder="Contoh: Juli 2025" value="{{ old('bulan_pembayaran') }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_bayar" class="form-label">Jumlah Bayar (Rp)</label>
                        <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror" id="jumlah_bayar" name="jumlah_bayar" value="{{ old('jumlah_bayar') }}" required>
                        @error('jumlah_bayar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                     <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2">{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Script untuk menampilkan/menyembunyikan field bulan pembayaran
    document.addEventListener('DOMContentLoaded', function() {
        const jenisPembayaranSelect = document.getElementById('jenis_pembayaran');
        const bulanPembayaranWrapper = document.getElementById('bulan-pembayaran-wrapper');

        function toggleBulanPembayaran() {
            if (jenisPembayaranSelect.value === 'SPP') {
                bulanPembayaranWrapper.style.display = 'block';
            } else {
                bulanPembayaranWrapper.style.display = 'none';
            }
        }

        toggleBulanPembayaran(); // Panggil saat halaman dimuat
        jenisPembayaranSelect.addEventListener('change', toggleBulanPembayaran); // Panggil saat pilihan berubah
    });
</script>
@endsection