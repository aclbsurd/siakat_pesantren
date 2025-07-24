<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    /**
     * Menampilkan semua pengaduan (khusus admin).
     */
    public function index()
    {
        // Hanya admin yang dapat melihat semua pengaduan
        $pengaduan = Pengaduan::with('user')->orderByDesc('tanggal')->get();
        return view('pengaduan.index', compact('pengaduan'));
    }

    /**
     * Form input pengaduan (untuk user biasa/tamu jika diperlukan).
     */
    public function create()
    {
        return view('pengaduan.create');
    }

    /**
     * Simpan pengaduan baru (bisa dari user login maupun tamu).
     */
    public function store(Request $request)
{
    $request->validate([
        'isi_pesan' => 'required|string|max:1000',
    ]);

    Pengaduan::create([
        'user_id' => Auth::check() ? Auth::id() : null, // bisa null jika tamu
        'isi_pesan' => $request->isi_pesan,
        'status' => 'pending',
        'tanggal' => now(),
    ]);

    return back()->with('success', 'Pengaduan berhasil dikirim.');
}

    /**
     * Memperbarui status pengaduan (admin).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,ditindaklanjuti',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status pengaduan telah diperbarui.');
    }

    /**
     * Menghapus pengaduan (admin).
     */
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();

        return redirect()->back()->with('success', 'Pengaduan berhasil dihapus.');
    }
}
