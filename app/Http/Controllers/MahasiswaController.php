<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Request  as studentRequestEdit;

class MahasiswaController extends Controller
{
    public function index()
    {
        $kelasId = auth()->user()->dosen->kelas_id; 

        // mahasiswa yang memiliki kelas yang sama dengan kelas dosen wali
        $mahasiswa = Mahasiswa::where('kelas_id', $kelasId)
            ->orWhereNull('kelas_id') 
            ->get();

        return view('manage-mahasiswa.index', compact('mahasiswa'));
    }


    // Tambah data mahasiswa
    public function create()
    {
        $kelas = Kelas::all();
        return view('manage-mahasiswa.create', compact('kelas'));
    }

    // proses form tambah mahasiswa
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'nullable|exists:kelas,id',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // membuat user baru
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'mahasiswa'
        ]);

        // create mahasiswa
        Mahasiswa::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'nim' => $validated['nim'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'kelas_id' => $validated['kelas_id']
        ]);

        return redirect()->route('manage-mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan1');
    }


    public function show(Mahasiswa $mahasiswa)
    {
        return view('manage-mahasiswa.show', compact('mahasiswa'));
    }

    // fungsi edit
    public function edit(Mahasiswa $mahasiswa)
    {
        $kelas = Kelas::all();
        return view('manage-mahasiswa.edit', compact('mahasiswa', 'kelas'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('manage-mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate!');
    }

    // fungsi delete
    public function destroy(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->user) {
            $mahasiswa->user->delete();
        }

        $mahasiswa->delete();
        return redirect()->route('manage-mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus!');
    }

    // fungsi approve request edit data dari mahasiswa
    public function approveRequest($requestId)
    {
        $permohonan = studentRequestEdit::findOrFail($requestId);

        // Update status edit 
        $mahasiswa = Mahasiswa::findOrFail($permohonan->mahasiswa_id);
        $mahasiswa->edit = true;
        $mahasiswa->save();

        // Hapus permohonan setelah disetujui
        $permohonan->delete();

        return redirect()->back()->with('success', 'Permohonan edit data telah disetujui. Mahasiswa dapat mengedit datanya.');
    }

    // fungsi reject request edit data dari mahasiswa
    public function rejectRequest($requestId)
    {
        $permohonan = studentRequestEdit::findOrFail($requestId);
        $permohonan->delete();
        return redirect()->back()->with('success', 'Permohonan edit data telah ditolak.');
    }

    // show data request edit
    public function showRequestEdit()
    {
        $permohonan = studentRequestEdit::with('mahasiswa', 'kelas')->get();
        return view('manage-mahasiswa.permohonanEdit', compact('permohonan'));
    }
}
