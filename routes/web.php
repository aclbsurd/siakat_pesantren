<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\

{
    AuthController,
    DashboardController,
    PengajarController,
    PembayaranController,
    SantriController,
    PengaduanController,
    JadwalController
};
use Illuminate\Support\Facades\Hash;
use App\Models\Santri;

Route::get('/reset-pass-santri', function () {
    $santri = Santri::where('nis', '256769')->first();

    if (!$santri) {
        return '❌ Santri tidak ditemukan.';
    }

    $santri->password = Hash::make('admin123');
    $santri->save();

    return '✅ Password santri NIS 256769 berhasil di-reset jadi: admin123';
});


// Middleware default Laravel
Route::middleware('web')->group(function () {

    // === LANDING PAGE ===
   Route::get('/', function (Request $request) {
    if ($request->session()->has('santri_id')) {
        return redirect()->route('santri.jadwal');
    } elseif ($request->session()->has('pengajar_id')) {
        return redirect()->route('pengaduan.create');
    } elseif (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('home');


    // === LOGIN ADMIN ===
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.admin');

    // === LOGIN SANTRI ===
   Route::get('/login/santri', [AuthController::class, 'showSantriLoginForm'])->name('login.santri');
   Route::post('/login/santri', [AuthController::class, 'santriLogin'])->name('login.santri.post');


    // === LOGIN PENGAJAR ===
    Route::get('/login/pengajar', [AuthController::class, 'showPengajarLoginForm'])->name('login.pengajar');
    Route::post('/login/pengajar', [AuthController::class, 'pengajarLogin'])->name('login.pengajar.post');

    // === LOGOUT ===
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // === ADMIN AREA ===
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('santri', SantriController::class);
        Route::resource('pengajar', PengajarController::class);
        Route::resource('pembayaran', PembayaranController::class);
        Route::get('/pembayaran/{pembayaran}/cetak', [PembayaranController::class, 'cetakKuitansi'])->name('pembayaran.cetak');
        Route::resource('jadwal', JadwalController::class);
        Route::resource('pengaduan', PengaduanController::class)->except(['store']);
    });

// Proteksi halaman khusus santri
   Route::middleware('cekSantri')->group(function () {
    Route::get('/santri/jadwal', [JadwalController::class, 'jadwalSantri'])->name('santri.jadwal');
});


    // === PENGAJAR AREA ===
     Route::middleware('cekPengajar')->group(function () {
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create'); // ← gunakan route yang ada
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
});


    // === DEBUG SESSION ===
    Route::get('/cek-session', fn () => session()->all());
    Route::get('/reset-session', function () {
        session()->flush();
        return redirect('/')->with('success', 'Session berhasil direset.');
    })->name('reset.session');
});
