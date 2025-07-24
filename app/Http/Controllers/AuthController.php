<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Santri;
use App\Models\Pengajar;

class AuthController extends Controller
{
    /**
     * Tampilkan form login utama (Admin)
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Tampilkan form login Santri
     */
    public function showSantriLoginForm()
    {
        return view('auth.login-santri');
    }

    /**
     * Tampilkan form login Pengajar
     */
    public function showPengajarLoginForm()
    {
        return view('auth.login-pengajar');
    }

    // LOGIN SANTRI
 public function santriLogin(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $santri = Santri::where('nis', $request->username)->first();

    if (!$santri) {
        return back()->with('error', 'Santri tidak ditemukan.');
    }

    if (!Hash::check($request->password, $santri->password)) {
        return back()->with('error', 'Password salah.');
    }

    session([
        'santri_id' => $santri->id,
        'santri_nama' => $santri->nama_lengkap,
        'kelas_id' => $santri->kelas_id,
    ]);

    return redirect()->route('santri.jadwal');
}



    /**
     * Proses login Pengajar
     */
    public function pengajarLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $pengajar = Pengajar::where('nip', $request->username)->first();

        if ($pengajar && Hash::check($request->password, $pengajar->password)) {
            session([
                'pengajar_id' => $pengajar->id,
                'pengajar_nama' => $pengajar->nama_lengkap
            ]);
            session()->save();

           return redirect()->route('pengaduan.create')->with('success', 'Login Pengajar berhasil.');
        }

        return back()->withErrors(['username' => 'NIP atau password salah.'])->withInput();
    }

    /**
     * Proses login Admin
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput();
    }

    /**
     * Logout semua role (Admin, Santri, Pengajar)
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Untuk admin (guard bawaan)

        $request->session()->forget([
            'santri_id', 'pengajar_id',
            'santri_nama', 'pengajar_nama',
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout.');
    }
}
