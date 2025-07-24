<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - SIAKAD Pesantren</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body { background-color: #f8f9fa; }
        .sidebar { width: 260px; min-height: 100vh; }
        .main-wrapper { display: flex; min-height: 100vh; }
        .main-content { flex-grow: 1; display: flex; flex-direction: column; }
        @media (min-width: 992px) { .main-content { margin-left: 260px; } }
        .sidebar .nav-link { font-size: 0.95rem; color: rgba(255, 255, 255, 0.8); transition: all 0.2s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background-color: #495057; }
        .sidebar .nav-link .icon { width: 1.2rem; height: 1.2rem; margin-right: 0.8rem; }
        .sidebar .sidebar-header { font-weight: 600; }
        .sidebar .nav-heading { font-size: .75rem; color: rgba(255, 255, 255, 0.5); padding: 0 1.25rem; margin-top: 1rem; text-transform: uppercase; }
    </style>
</head>
<body>

<div class="main-wrapper">
    {{-- Sidebar Desktop --}}
    <aside class="sidebar bg-dark text-white flex-column p-3 position-fixed d-none d-lg-flex">
        <a href="{{ route('home') }}" class="d-flex align-items-center mb-3 text-white text-decoration-none">
            <i class="bi bi-mortarboard-fill fs-4 me-2"></i>
            <span class="fs-5 sidebar-header">SIAKAD Pesantren</span>
        </a>
        <hr>
        @include('layouts.partials._sidebar_menu')
    </aside>

    {{-- Sidebar Mobile --}}
    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header border-bottom border-secondary">
            <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Menu Utama</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @include('layouts.partials._sidebar_menu')
        </div>
    </div>

    {{-- Main Content --}}
    <div class="main-content">
        {{-- Navbar --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
            <div class="container-fluid">
                <button class="btn btn-light d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
                    <i class="bi bi-list"></i>
                </button>
                <h5 class="navbar-brand mb-0 fw-bold d-none d-sm-block">@yield('title')</h5>
                <div class="dropdown ms-auto">
                    @php
                        $namaLogin = Auth::check()
                            ? (Auth::user()->nama ?? Auth::user()->nama_lengkap ?? 'Admin')
                            : (session('santri_nama') ?? session('pengajar_nama') ?? 'Pengguna');
                    @endphp
                    <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-4 me-2"></i>
                        <strong>{{ $namaLogin }}</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Halaman Konten --}}
        <main class="p-4 flex-grow-1">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="py-3 bg-white border-top">
            <div class="container-fluid text-center">
                <small class="text-muted">
                    &copy; {{ date('Y') }} Pondok Pesantren Al Fatah Komplek Dar El Hasani. All Rights Reserved.
                </small>
            </div>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
