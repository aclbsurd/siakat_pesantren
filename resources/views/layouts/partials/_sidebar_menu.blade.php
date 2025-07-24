@php
    $namaLogin = Auth::check()
        ? (Auth::user()->nama ?? Auth::user()->nama_lengkap ?? 'Admin')
        : (session('pengajar_nama') ?? session('santri_nama') ?? 'Pengguna');

    $isAdmin = Auth::check();
    $isSantri = session()->has('santri_id');
    $isPengajar = session()->has('pengajar_id');
@endphp

<div class="mb-3">
    Selamat datang, <strong>{{ $namaLogin }}</strong>
</div>

<ul class="nav nav-pills flex-column mb-auto">

    {{-- Menu untuk Admin --}}
    @if ($isAdmin)
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-heading text-uppercase text-muted fw-bold small mt-3 mb-2">Master Data</li>
        <li class="nav-item">
            <a href="{{ route('santri.index') }}" class="nav-link {{ request()->is('santri*') ? 'active' : '' }}">
                <i class="bi bi-people-fill me-2"></i> Data Santri
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pengajar.index') }}" class="nav-link {{ request()->is('pengajar*') ? 'active' : '' }}">
                <i class="bi bi-person-video3 me-2"></i> Data Pengajar
            </a>
        </li>

        <li class="nav-heading text-uppercase text-muted fw-bold small mt-3 mb-2">Akademik</li>
        <li class="nav-item">
            <a href="{{ route('jadwal.index') }}" class="nav-link {{ request()->is('jadwal*') ? 'active' : '' }}">
                <i class="bi bi-calendar-week me-2"></i> Jadwal
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pembayaran.index') }}" class="nav-link {{ request()->is('pembayaran*') ? 'active' : '' }}">
                <i class="bi bi-wallet-fill me-2"></i> Keuangan
            </a>
        </li>

        <li class="nav-heading text-uppercase text-muted fw-bold small mt-3 mb-2">Layanan</li>
        <li class="nav-item">
            <a href="{{ route('pengaduan.index') }}" class="nav-link {{ request()->is('pengaduan*') ? 'active' : '' }}">
                <i class="bi bi-chat-dots-fill me-2"></i> Pengaduan
            </a>
        </li>
    @endif

    {{-- Menu untuk Santri --}}
    @if ($isSantri)
        <li class="nav-item">
            <a href="{{ route('santri.jadwal') }}" class="nav-link {{ request()->is('santri/jadwal') ? 'active' : '' }}">
                <i class="bi bi-calendar-week me-2"></i> Jadwal Saya
            </a>
        </li>
    @endif
{{-- Menu untuk Pengajar --}}
@if ($isPengajar)
    <li class="nav-item">
        <a href="{{ route('pengaduan.create') }}" class="nav-link {{ request()->is('pengaduan/create') ? 'active' : '' }}">
    <i class="bi bi-chat-text me-2"></i> Form Pengaduan
</a>
    </li>
@endif

</ul>
