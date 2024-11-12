<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();
        return view('manage-dosen.index', compact('dosen'));
    }

    public function create()
    {
        // Kelas yang belum memiliki wali kelas
        $kelasTanpaWali = Kelas::doesntHave('dosen')->get();
        $semuaKelas = Kelas::with('dosen')->get();

        return view('manage-dosen.create', compact('kelasTanpaWali', 'semuaKelas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|integer|unique:dosen',
            'kode_dosen' => 'required|integer',
            'kelas_id' => 'nullable|exists:kelas,id',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create the user
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'dosen'
        ]);

        $dosen = Dosen::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'nip' => $validated['nip'],
            'kode_dosen' => $validated['kode_dosen'],
            'kelas_id' => $validated['kelas_id'],
        ]);

        return redirect()->route('manage-dosen.index')->with('success', 'Data dosen berhasil dibuat');
    }


    public function show(Dosen $dosen)
    {
        return view('manage-dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen)
    {
        //kelas yang belum memiliki wali kelas
        $kelasTanpaWali = Kelas::doesntHave('dosen')->get();

        $semuaKelas = Kelas::with('dosen')->get();

        return view('manage-dosen.edit', compact('dosen', 'kelasTanpaWali', 'semuaKelas'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|integer|unique:dosen,nip,' . $dosen->id,
            'kode_dosen' => 'required|integer',
            'kelas_id' => 'nullable|exists:kelas,id',
            'password' => 'nullable|string|min:8',
        ]);

        // dd($validated);

        $dosen->update([
            'name' => $validated['name'],
            'nip' => $validated['nip'],
            'kode_dosen' => $validated['kode_dosen'],
            'kelas_id' => $validated['kelas_id'] ?? null,
        ]);

        // Kalau ada password baru, hash dan update
        if ($request->has('password') && $request->password != '') {
            $dosen->user->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect()->route('manage-dosen.index')->with('success', 'Data dosen berhasil diperbarui');
    }

    public function destroy(Dosen $dosen)
    {
        if ($dosen->user) {
            $dosen->user->delete();
        }

        // Hapus dosen
        $dosen->delete();

        return redirect()->route('manage-dosen.index')->with('success', 'Data dosen berhasil dihapus');
    }

    public function __construct()
    {
        $this->middleware('role:kaprodi');
    }
}
