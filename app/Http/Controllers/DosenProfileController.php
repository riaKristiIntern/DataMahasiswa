<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenProfileController extends Controller
{
    public function profile()
    {
        $dosen = auth()->user()->dosen;
        $user = auth()->user();

        if (!$dosen) {
            return redirect()->route('dashboard')->with('error', 'Data dosen tidak ditemukan.');
        }

        return view('dosenProfile.index', compact('dosen'));
    }

    // Fungsi edit data diri
    public function edit()
    {
        $dosen = auth()->user()->dosen;
        $user = auth()->user();

        if (!$dosen) {
            return redirect()->route('dashboard')->with('error', 'Data dosen tidak ditemukan.');
        }

        return view('dosenProfile.edit', compact('dosen'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'kode_dosen' => 'required|unique:dosen,kode_dosen,' . auth()->user()->dosen->id,
            'nip' => 'required|unique:dosen,nip,' . auth()->user()->dosen->id,
            'name' => 'required',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $dosen = auth()->user()->dosen;
        $user = auth()->user();

        if (!$dosen) {
            return redirect()->route('dashboard')->with('error', 'Data dosen tidak ditemukan.');
        }

        $dosen->kode_dosen = $request->kode_dosen;
        $dosen->nip = $request->nip;
        $dosen->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        $user->save();
        $dosen->save();

        // Redirect berdasarkan role dosen
        if ($user->role == 'dosen wali') {
            return redirect()->route('dosenWali.profile')->with('success', 'Data diri berhasil diperbarui.');
        } else {
            return redirect()->route('dosenBiasa.profile')->with('success', 'Data diri berhasil diperbarui.');
        }
    }
}
