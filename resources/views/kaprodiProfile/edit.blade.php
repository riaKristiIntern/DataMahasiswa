@extends('components.layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Data Diri Dosen</h1>

    @if($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('kaprodi.update') }}" method="POST">
        @csrf
        <div class="bg-white shadow-md rounded-lg p-4">
            <div class="mb-4">
                <label for="kode_dosen" class="block text-gray-700">Kode Dosen</label>
                <input type="text" name="kode_dosen" id="kode_dosen" value="{{ $kaprodi->kode_dosen }}" class="mt-1 block w-full border rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="nip" class="block text-gray-700">NIP</label>
                <input type="text" name="nip" id="nip" value="{{ $kaprodi->nip }}" class="mt-1 block w-full border rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ $kaprodi->name }}" class="mt-1 block w-full border rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" name="username" id="username" value="{{ $kaprodi->user->username }}" class="mt-1 block w-full border rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="text" name="email" id="email" value="{{ $kaprodi->user->email }}" class="mt-1 block w-full border rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
            </div>
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection