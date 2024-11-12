@extends('components.layout')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Edit Mahasiswa</h1>

    @if($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('manage-mahasiswa.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nama Mahasiswa</label>
            <input type="text" name="name" id="name" class="w-full border rounded-lg p-2" value="{{ $mahasiswa->name }}" required>
        </div>

        <div class="mb-4">
            <label for="nim" class="block text-gray-700">NIM</label>
            <input type="text" name="nim" id="nim" class="w-full border rounded-lg p-2" value="{{ $mahasiswa->nim }}" required>
        </div>

        <div class="mb-4">
            <label for="tempat_lahir" class="block text-gray-700">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full border rounded-lg p-2" value="{{ $mahasiswa->tempat_lahir }}" required>
        </div>

        <div class="mb-4">
            <label for="tanggal_lahir" class="block text-gray-700">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full border rounded-lg p-2" value="{{ $mahasiswa->tanggal_lahir->format('Y-m-d') }}" required>
        </div>

        <!-- Dropdown untuk kelas -->
        <div class="mb-4">
            <label for="kelas_id" class="block text-gray-700">Kelas</label>
            <select name="kelas_id" id="kelas_id" class="border p-2 w-full">
                <option value="">Tidak Ditugaskan</option>
                @foreach ($kelas as $kelasItem)
                <option value="{{ $kelasItem->id }}" {{ $mahasiswa->kelas_id == $kelasItem->id ? 'selected' : '' }}>{{ $kelasItem->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Update</button>
    </form>
</div>


@endsection