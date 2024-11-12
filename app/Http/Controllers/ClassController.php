<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClassController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('mahasiswa')->get();
        $kelas = Kelas::with('dosen')->get();
        $dosen = Dosen::whereNull('kelas_id')->get(); // dosen yang belum punya kelas

        return view('manage-class.index', compact('kelas', 'dosen'));
    }

    public function create()
    {
        return view('manage-class.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'jumlah' => 'required|integer',
        ]);

        Kelas::create($validated);

        return redirect()->route('manage-class.index')->with('success', 'Data kelas berhasil dibuat');
    }

    // menamplkan daftar mahasiswa di kelas
    public function show(Kelas $kelas)
    {
        $Mahasiswas = $kelas->mahasiswa;
        return view('manage-class.show', compact('kelas', 'mahasiswa'));
    }

    public function edit(Kelas $kelas)
    {
        // dd($kelas);
        return view('manage-class.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
        ]);

        $kelas->update($validated);

        return redirect()->route('manage-class.index')->with('success', 'Data kelas berhasil diperbarui');
    }

    public function destroy(Kelas $kelas)
    {
        try {
            Log::info('Menghapus kelas dengan ID: ' . $kelas->id);
            $kelas->delete();
            return redirect()->route('manage-class.index')->with('success', 'Data kelas berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error saat menghapus kelas: ' . $e->getMessage());
            return redirect()->route('manage-class.index')->withErrors('Gagal menghapus kelas');
        }
    }

    // menambahkan mahasiswa
    // public function addMahasiswa(Request $request, Kelas $kelas)
    // {
    //     $validated = $request->validate([
    //         'mahasiswa_id' => 'required|exists:mahasiswa,id',
    //     ]);

    //     $mahasiswa = Mahasiswa::find($validated['mahasiswa_id']);
    //     $mahasiswa->kelas_id = $kelas->id;
    //     $mahasiswa->save();

    //     return redirect()->route('manage-class.show', $kelas->id)->with('success', 'Mahasiswa berhasil ditambahkan ke kelas.');
    // }

    public function __construct()
    {
        $this->middleware('role:kaprodi');
    }
}
