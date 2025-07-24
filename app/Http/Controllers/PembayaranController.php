<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran; // <-- Import
use Illuminate\Http\Request; // <-- Import
use Illuminate\Support\Facades\Auth;
use App\Models\Santri;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $pembayarans = Pembayaran::with(['santri', 'user']) // Eager loading
        ->when($search, function ($query, $search) {
            // Logika pencarian berdasarkan nama santri
            return $query->whereHas('santri', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%");
            });
        })
        ->latest('tanggal_bayar') // Urutkan berdasarkan tanggal bayar
        ->paginate(15);

    return view('pembayaran.index', compact('pembayarans'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Ambil santri yang berstatus aktif saja
    $santris = Santri::where('status', 'Aktif')->orderBy('nama_lengkap')->get();
    return view('pembayaran.create', compact('santris'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'santri_id' => 'required|exists:santri,id',
        'tanggal_bayar' => 'required|date',
        'jenis_pembayaran' => 'required|string',
        'bulan_pembayaran' => 'nullable|string',
        'jumlah_bayar' => 'required|integer|min:0',
        'keterangan' => 'nullable|string',
    ]);

    // Tambahkan user_id (admin yang login) dan status default
    $validated['user_id'] = Auth::id();
    $validated['status'] = 'Lunas';

    // Simpan ke database
    Pembayaran::create($validated);

    return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil disimpan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        // Ambil semua santri yang berstatus aktif untuk ditampilkan di dropdown.
        $santris = Santri::where('status', 'Aktif')->orderBy('nama_lengkap')->get();
        
        // Kirim data pembayaran yang spesifik dan daftar santri ke view 'edit'.
        return view('pembayaran.edit', compact('pembayaran', 'santris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        // Validasi data yang diinput dari form edit.
        $validated = $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'tanggal_bayar' => 'required|date',
            'jenis_pembayaran' => 'required|string',
            'bulan_pembayaran' => 'nullable|string',
            'jumlah_bayar' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        // Lakukan update pada data yang ada.
        $pembayaran->update($validated);

        // Redirect kembali ke halaman index dengan pesan sukses.
        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
{
    $pembayaran->delete();

    return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus.');
}
// app/Http/Controllers/PembayaranController.php

public function cetakKuitansi(Pembayaran $pembayaran)
{
    // Eager load relasi untuk memastikan data santri dan user tersedia di view
    $pembayaran->load(['santri', 'user']);
    
    // Fungsi untuk mengubah angka menjadi terbilang
    $terbilang = $this->terbilang($pembayaran->jumlah_bayar);

    return view('pembayaran.kuitansi', compact('pembayaran', 'terbilang'));
}

// Tambahkan helper function untuk terbilang di dalam controller
private function terbilang($angka) {
    $angka = abs($angka);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($angka < 12) {
        $temp = " ". $huruf[$angka];
    } else if ($angka < 20) {
        $temp = $this->terbilang($angka - 10). " belas";
    } else if ($angka < 100) {
        $temp = $this->terbilang($angka/10)." puluh". $this->terbilang($angka % 10);
    } else if ($angka < 200) {
        $temp = " seratus" . $this->terbilang($angka - 100);
    } else if ($angka < 1000) {
        $temp = $this->terbilang($angka/100) . " ratus" . $this->terbilang($angka % 100);
    } else if ($angka < 2000) {
        $temp = " seribu" . $this->terbilang($angka - 1000);
    } else if ($angka < 1000000) {
        $temp = $this->terbilang($angka/1000) . " ribu" . $this->terbilang($angka % 1000);
    } else if ($angka < 1000000000) {
        $temp = $this->terbilang($angka/1000000) . " juta" . $this->terbilang($angka % 1000000);
    }
    return ucwords(trim($temp)) . " Rupiah";
}
}
