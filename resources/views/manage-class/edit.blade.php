@extends('components.layout')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Kelas</h1>

    @if($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- {{ dd($kelas) }} --}}

    <form action="{{ route('manage-class.update', $kelas->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nama Kelas</label>
            <input type="text" name="name" value="{{ $kelas->name }}" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label for="jumlah" class="block text-gray-700">Kapasitas</label>
            <input type="number" name="jumlah" value="{{ $kelas->jumlah }}"
                class="w-full px-4 py-2 border rounded-lg">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection