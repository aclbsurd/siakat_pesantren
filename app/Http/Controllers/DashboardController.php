<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pengajar;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama (hanya untuk admin).
     */
    public function index()
    {
        $jumlahSantri   = Santri::where('status', 'Aktif')->count();
        $jumlahPengajar = Pengajar::count();
        $jumlahKelas    = Kelas::count();

        $user = Auth::user(); // hanya tersedia untuk admin

        return view('dashboard.index', compact(
            'jumlahSantri',
            'jumlahPengajar',
            'jumlahKelas',
            'user'
        ));
    }
}
