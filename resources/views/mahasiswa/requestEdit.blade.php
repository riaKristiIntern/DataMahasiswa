@extends('components.layout')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">Ajukan Permohonan Edit Data</h2>

    <form action="{{ route('mahasiswa.requestEdit') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="keterangan" class="block text-gray-700 font-medium mb-2">Keterangan</label>
            <textarea
                id="keterangan"
                name="keterangan"
                placeholder="Jelaskan data yang ingin diubah"
                class="w-full h-32 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required></textarea>
        </div>

        <div class="text-center">
            <button
                type="submit"
                class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                Ajukan Permohonan Edit
            </button>
        </div>
    </form>
</div>
@endsection