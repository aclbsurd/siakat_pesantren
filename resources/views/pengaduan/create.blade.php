@extends('layouts.app')

@section('title', 'Form Pengaduan')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Form Pengaduan</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pengaduan.store') }}">
        @csrf

        <div class="mb-3">
            <label for="isi_pesan" class="form-label">Isi Pesan</label>
            <textarea name="isi_pesan" id="isi_pesan" rows="5" class="form-control @error('isi_pesan') is-invalid @enderror" required>{{ old('isi_pesan') }}</textarea>
            @error('isi_pesan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
    </form>
</div>
@endsection
