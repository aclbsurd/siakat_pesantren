<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Pengajar;
use App\Models\Santri;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Halaman jadwal untuk santri yang sedang login.
     */
    public function jadwalSantri()
{
    $santri = Santri::find(session('santri_id'));
    $jadwal = Jadwal::with('pengajar')
        ->where('kelas_id', $santri->kelas_id)
        ->orderBy('hari')->orderBy('jam')->get();

    return view('santri.jadwal', compact('santri', 'jadwal'));
}


    /**
     * Halaman jadwal untuk pengajar yang sedang login.
     */
    public function jadwalPengajar()
    {
        $pengajarId = session('pengajar_id');
        $pengajar = Pengajar::find($pengajarId);

        if (!$pengajar) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $jadwal = Jadwal::with('kelas')
            ->where('pengajar_id', $pengajar->id)
            ->orderBy('hari')
            ->orderBy('jam')
            ->get();

        return view('jadwal.pengajar', compact('jadwal'));
    }

    /**
     * Menampilkan semua jadwal (admin).
     */
    public function index()
    {
        $jadwal = Jadwal::with(['pengajar', 'kelas'])
            ->orderBy('hari')
            ->orderBy('jam')
            ->get();

        return view('jadwal.index', compact('jadwal'));
    }

    /**
     * Form tambah jadwal (admin).
     */
    public function create()
    {
        $pengajars = Pengajar::all();
        $kelases = Kelas::all();

        return view('jadwal.create', compact('pengajars', 'kelases'));
    }

    /**
     * Simpan data jadwal baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id'     => 'required|exists:kelas,id',
            'pengajar_id'  => 'required|exists:pengajar,id',
            'hari'         => 'required|string|max:20',
            'jam'          => 'required|string|max:20',
           'mata_pelajaran' => 'required|string|max:255',
        ]);

       Jadwal::create([
    'kelas_id'         => $request->kelas_id,
    'pengajar_id'      => $request->pengajar_id,
    'hari'             => $request->hari,
    'jam'              => $request->jam,
    'mata_pelajaran'   => $request->mata_pelajaran,
]);


        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Form edit jadwal berdasarkan ID.
     */
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $kelas = Kelas::all();
        $pengajar = Pengajar::all();

        return view('jadwal.edit', compact('jadwal', 'kelas', 'pengajar'));
    }

    /**
     * Update data jadwal.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kelas_id'     => 'required|exists:kelas,id',
            'pengajar_id'  => 'required|exists:pengajar,id',
            'hari'         => 'required|string|max:20',
            'jam'          => 'required|string|max:20',
            'mapel'        => 'required|string|max:255',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
    'kelas_id'         => $request->kelas_id,
    'pengajar_id'      => $request->pengajar_id,
    'hari'             => $request->hari,
    'jam'              => $request->jam,
    'mata_pelajaran'   => $request->mata_pelajaran,
]);


        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Hapus data jadwal.
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
