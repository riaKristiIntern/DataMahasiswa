@extends('components.layout')

@section('title', 'Create Class')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Buat Kelas Baru</h1>

    @if($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('manage-class.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nama Kelas</label>
            <input type="text" name="name" id="name" class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label for="jumlah" class="block text-gray-700">Kapasistas</label>
            <input type="number" name="jumlah" id="jumlah" class="w-full border rounded-lg p-2" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Buat</button>
    </form>
</div>
@endsection