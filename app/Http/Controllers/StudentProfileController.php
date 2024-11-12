<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Request  as studentRequestEdit;

class StudentProfileController extends Controller
{
    public function profile()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function showRequestEditForm()
    {
        return view('mahasiswa.requestEdit');
    }


    public function requestEdit(Request $request)
    {
        $mahasiswa = auth()->user()->mahasiswa;

        // Cek apakah sudah ada permohonan yang menunggu persetujuan
        if ($mahasiswa->edit) {
            return redirect()->back()->with('error', 'Anda sudah memiliki permohonan yang sedang diproses.');
        }

        // dd($request->all());

        // Validasi data permohonan
        $request->validate([
            'keterangan' => 'required|string', // Keterangan mengenai alasan permohonan edit
        ]);

        try {
            Log::info("Request edit started for mahasiswa_id: {$mahasiswa->id}");

            // Simpan permohonan ke tabel request
            studentRequestEdit::create([
                'kelas_id' => $mahasiswa->kelas_id,
                'mahasiswa_id' => $mahasiswa->id,
                'keterangan' => $request->input('keterangan'),
            ]);
            Log::info("Request edit data created successfully for mahasiswa_id: {$mahasiswa->id}");
            // Update status edit di tabel mahasiswa

            // Berikan pesan keberhasilan ke session flash
            return redirect()->route('mahasiswa.index')->with('success', 'Permohonan edit data telah diajukan.');
        } catch (\Exception $e) {
            Log::error("Error in requestEdit: " . $e->getMessage());
            // Berikan pesan error jika terjadi kegagalan
            return redirect()->route('mahasiswa.index')->with('error', 'Gagal mengajukan permohonan edit.');
        }
    }

    // mengimpan perubahan data setelah request edit di approve oleh dosen wali
    public function saveEdit(Request $request)
    {
        $mahasiswa = auth()->user()->mahasiswa;

        // Pastikan mahasiswa memang memiliki hak akses edit
        if (!$mahasiswa->edit) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit data.');
        }

        // Validasi data yan~g akan disimpan
        $request->validate([
            'name' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);
        // Update data mahasiswa
        $mahasiswa->update([
            'name' => $request->input('name'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
        ]);

        // Nonaktifkan hak akses edit setelah penyimpanan selesai
        $mahasiswa->edit = false;
        $mahasiswa->save();

        return redirect()->route('mahasiswa.index')->with('success', 'Data Anda telah diperbarui.');
    }
}
