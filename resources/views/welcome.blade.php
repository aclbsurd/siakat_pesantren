<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda - SIAKAD Pesantren</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.6)), 
                        url('https://source.unsplash.com/1600x700/?islamic,school') center center;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 120px 30px;
        }
        .feature-icon { font-size: 2.5rem; color: #0d6efd; }
        footer { background-color: #0d6efd; color: white; padding: 40px 0; }
        .social-icons a { color: white; margin: 0 10px; font-size: 1.2rem; }
    </style>
</head>
<body>
@if (session()->has('santri_id') || session()->has('pengajar_id') || Auth::check())
    <div style="text-align:center; margin-top:20px;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">🔁 Reset Session</button>
        </form>
    </div>
@endif


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">SIAKAD PESANTREN</a>
        <div class="text-center mt-4">
            <a href="{{ route('login.santri') }}" class="btn btn-success">Login Santri</a>
            <a href="{{ route('login.pengajar') }}" class="btn btn-primary">Login Pengajar</a>
            <a href="{{ route('login.admin') }}" class="btn btn-dark">Login Admin</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero">
    <h1 class="display-4 fw-bold">Sistem Akademik Pondok Pesantren</h1>
    <p class="lead">Mengelola data santri & pengajar dengan teknologi modern.</p>
    <a href="#pengaduan" class="btn btn-light btn-lg">Kirim Pengaduan</a>
</div>

<!-- Video Profil -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="mb-4">Profil Pesantren</h2>
        <div class="ratio ratio-16x9">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/YYfdt64egjg?si=0WBwtrP00zGool62" 
                title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; 
                encrypted-media; gyroscope; picture-in-picture; web-share" 
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
            </iframe>
        </div>
    </div>
</section>

<!-- Fitur Unggulan -->
<section class="py-5">
    <div class="container text-center">
        <h2 class="mb-4">Fitur Unggulan</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-icon">📊</div>
                <h5>Manajemen Akademik</h5>
                <p>Data santri, nilai, jadwal, dan kehadiran dalam satu sistem.</p>
            </div>
            <div class="col-md-4">
                <div class="feature-icon">🔒</div>
                <h5>Keamanan Data</h5>
                <p>Dibangun dengan Laravel, sistem ini aman dan efisien.</p>
            </div>
            <div class="col-md-4">
                <div class="feature-icon">⚡</div>
                <h5>Akses Mudah</h5>
                <p>Bisa diakses melalui komputer pondok, tanpa perlu HP santri.</p>
            </div>
        </div>
    </div>
</section>

<!-- Pengaduan -->
<section id="pengaduan" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Form Pengaduan</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        <form action="{{ route('pengaduan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="isi_pesan" class="form-label">Isi Pengaduan</label>
                <textarea name="isi_pesan" id="isi_pesan" class="form-control" rows="5" required></textarea>
            </div>

            @auth
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            @else
                <input type="hidden" name="user_id" value="">
            @endauth

            <input type="hidden" name="tanggal" value="{{ now() }}">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-send-fill me-1"></i> Kirim
            </button>
        </form>
    </div>
</section>

<!-- Footer -->
<footer class="text-center mt-5">
    <div class="container">
        <p class="fw-bold">Pondok Pesantren Al Fatah Komplek Dar El Hasani</p>
        <p>Jl. Kyai Kholil No. 12, Banjarnegara, Jawa Tengah | Email: info@alfatah.ac.id</p>
        <div class="social-icons">
            <a href="https://instagram.com" target="_blank"><i class="bi bi-instagram"></i></a>
            <a href="https://facebook.com" target="_blank"><i class="bi bi-facebook"></i></a>
            <a href="https://youtube.com" target="_blank"><i class="bi bi-youtube"></i></a>
        </div>
        <p class="mt-3">&copy; {{ date('Y') }} SIAKAD Pesantren | Dibangun dengan ❤️ Laravel</p>
    </div>
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
