<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaprodiProfileController extends Controller
{
    public function profile()
    {
        $kaprodi = Auth::user()->kaprodi;

        if (!$kaprodi) {
            return redirect()->route('dashboard')->with('error', 'Data kaprodi tidak ditemukan.');
        }

        return view('kaprodiProfile.index', compact('kaprodi'));
    }

    // fugnsi edit data diri
    public function edit()
    {
        $kaprodi = auth()->user()->kaprodi;

        if (!$kaprodi) {
            return redirect()->route('dashboard')->with('error', 'Data kaprodi tidak ditemukan.');
        }

        return view('kaprodiProfile.edit', compact('kaprodi'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'kode_dosen' => 'required|unique:kaprodi,kode_dosen,' . auth()->user()->kaprodi->id,
            'nip' => 'required|unique:kaprodi,nip,' . auth()->user()->kaprodi->id,
            'name' => 'required',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $kaprodi = auth()->user()->kaprodi;

        if (!$kaprodi) {
            return redirect()->route('dashboard')->with('error', 'Data kaprodi tidak ditemukan.');
        }

        $kaprodi->kode_dosen = $request->kode_dosen;
        $kaprodi->nip = $request->nip;
        $kaprodi->name = $request->name;
        $kaprodi->user->username = $request->username;
        $kaprodi->user->email = $request->email;

        $kaprodi->user->save();
        $kaprodi->save();

        return redirect()->route('kaprodi.profile')->with('success', 'Data diri berhasil diperbarui.');
    }
}
