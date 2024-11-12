@extends('components.layout')

@section('title', 'Edit Dosen')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Edit Dosen</h1>

    @if($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('manage-dosen.update', $dosen) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nama Dosen</label>
            <input type="text" name="name" id="name" value="{{ $dosen->name }}" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label for="nip" class="block text-gray-700">NIP</label>
            <input type="text" name="nip" id="nip" value="{{ $dosen->nip }}" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label for="kode_dosen" class="block text-gray-700">Kode Dosen</label>
            <input type="text" name="kode_dosen" id="kode_dosen" value="{{ $dosen->kode_dosen }}" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label for="username" class="block text-gray-700">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username', $dosen->user->username) }}" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $dosen->user->email) }}" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="w-full border rounded-lg p-2" placeholder="Kosongkan jika tidak diubah">
        </div>

        <div class="mb-4">
            <label for="kelas_id" class="block text-gray-700">Tugaskan ke Kelas</label>
            <select name="kelas_id" id="kelas_id" class="w-full border rounded-lg p-2">
                <option value="">Tidak ditugaskan</option>

                {{-- Kelas yang belum memiliki wali kelas --}}
                @foreach ($kelasTanpaWali as $kls)
                <option value="{{ $kls->id }}" {{ $dosen->kelas_id == $kls->id ? 'selected' : '' }}>
                    {{ $kls->name }}
                </option>
                @endforeach

                {{-- Kelas yang sudah memiliki wali kelas, disabled --}}
                @foreach ($semuaKelas as $kls)
                @if($kls->dosen)
                <option value="{{ $kls->id }}" disabled>
                    {{ $kls->name }} - (Sudah ada wali kelas)
                </option>
                @endif
                @endforeach
            </select>
        </div>


        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Update Dosen</button>
    </form>
</div>
@endsection