<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SantriController extends Controller
{
    /**
     * Menampilkan daftar santri.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $santris = Santri::with('kelas')
            ->when($search, function ($query, $search) {
                return $query->where('nama_lengkap', 'like', "%{$search}%")
                             ->orWhere('nis', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('santri.index', compact('santris'));
    }

    /**
     * Menampilkan form tambah santri.
     */
    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('santri.create', compact('kelas'));
    }

    /**
     * Menyimpan data santri baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:santri,nis|max:50',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'kelas_id' => 'nullable|exists:kelas,id',
            'nama_wali' => 'nullable|string',
            'no_telepon_wali' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['nis']);
        Santri::create($validated);

        return redirect('/santri/jadwal'); // atau ->route('santri.jadwal')
    }

    /**
     * Menampilkan detail santri.
     */
    public function show(Santri $santri)
    {
        return view('santri.show', compact('santri'));
    }

    /**
     * Menampilkan form edit santri.
     */
    public function edit(Santri $santri)
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('santri.edit', compact('santri', 'kelas'));
    }

    /**
     * Update data santri.
     */
    public function update(Request $request, Santri $santri)
    {
        $validated = $request->validate([
            'nis' => ['required', 'max:50', Rule::unique('santri')->ignore($santri->id)],
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'kelas_id' => 'nullable|exists:kelas,id',
            'nama_wali' => 'nullable|string',
            'no_telepon_wali' => 'nullable|string',
            'alamat' => 'nullable|string',
            'status' => 'required|in:Aktif,Lulus,Berhenti',
        ]);

        $validated['password'] = Hash::make($validated['nis']);
        $santri->update($validated);

        return redirect()->route('santri.index')->with('success', 'Data santri berhasil diperbarui.');
    }

    /**
     * Hapus data santri.
     */
    public function destroy(Santri $santri)
    {
        $santri->delete();
        return redirect()->route('santri.index')->with('success', 'Data santri berhasil dihapus.');
    }

    /**
     * Cetak data santri (PDF atau view printable).
     */
    public function cetak(Request $request)
    {
        $search = $request->input('search');

        $santris = Santri::with('kelas')
            ->when($search, function ($query, $search) {
                return $query->where('nama_lengkap', 'like', "%{$search}%")
                             ->orWhere('nis', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        $tanggalCetak = Carbon::now()->isoFormat('D MMMM Y');

        return view('santri.cetak', compact('santris', 'tanggalCetak', 'search'));
    }
}
