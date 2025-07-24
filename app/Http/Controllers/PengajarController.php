<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash; // Tambahkan ini di atas

use App\Models\Pengajar; // <-- Jangan lupa import model
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class PengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pengajars = Pengajar::when($search, function ($query, $search) {
                return $query->where('nama_lengkap', 'like', "%{$search}%")
                             ->orWhere('nip', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('pengajar.index', compact('pengajars'));
    }

    // Biarkan method lain kosong untuk saat ini
    /**
     * Show the form for creating a new resource.
     */
    // app/Http/Controllers/PengajarController.php

public function create()
{
    return view('pengajar.create');
}

    /**
     * Store a newly created resource in storage.
     */
    // app/Http/Controllers/PengajarController.php

public function store(Request $request)
{
    // 1. Validasi data
    $validated = $request->validate([
        'nip' => 'nullable|unique:pengajar,nip|max:50',
        'nama_lengkap' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'no_telepon' => 'nullable|string|max:20',
        'alamat' => 'nullable|string',
    ]);
    $validated['password'] = Hash::make($validated['nip']);

    // 2. Simpan data ke database
    Pengajar::create($validated);

    // 3. Redirect dengan pesan sukses
    return redirect()->route('pengajar.index')->with('success', 'Data pengajar berhasil ditambahkan.');
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
    // app/Http/Controllers/PengajarController.php

// Tambahkan Pengajar sebagai parameter untuk Route Model Binding
public function edit(Pengajar $pengajar)
{
    return view('pengajar.edit', compact('pengajar'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajar $pengajar)
{
    // Validasi dengan Rule::unique yang mengabaikan NIP pengajar saat ini
    $validated = $request->validate([
        'nip' => ['nullable', 'max:50', Rule::unique('pengajar')->ignore($pengajar->id)],
        'nama_lengkap' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'no_telepon' => 'nullable|string|max:20',
        'alamat' => 'nullable|string',
    ]);
    $validated['password'] = Hash::make($validated['nip']);

    $pengajar->update($validated);

    return redirect()->route('pengajar.index')->with('success', 'Data pengajar berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajar $pengajar)
{
    $pengajar->delete();

    return redirect()->route('pengajar.index')->with('success', 'Data pengajar berhasil dihapus.');
}
}
