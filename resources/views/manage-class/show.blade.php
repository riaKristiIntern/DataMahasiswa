@extends('layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Detail Kelas: {{ $kelas->name }}</h1>

    <h2 class="text-xl">Dosen Wali: {{ $kelas->dosen ? $kelas->dosen->name : 'Belum ada' }}</h2>
    
    <form action="{{ route('manage-class.assignDosen', $kelas->id) }}" method="POST">
        @csrf
        <label for="dosen">Pilih Dosen Wali:</label>
        <select name="dosen_id" id="dosen">
            @foreach($dosenList as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
            @endforeach
        </select>
        <button type="submit">Tetapkan</button>
    </form>

    <h2 class="text-xl">Mahasiswa</h2>
    <ul>
        @foreach($kelas->mahasiswa as $mahasiswa)
            <li>{{ $mahasiswa->name }}</li>
        @endforeach
    </ul>

    <form action="{{ route('class.addStudent', $kelas->id) }}" method="POST">
        @csrf
        <label for="mahasiswa">Tambah Mahasiswa:</label>
        <select name="mahasiswa_id" id="mahasiswa">
            @foreach($mahasiswaList as $mahasiswa)
                <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->name }}</option>
            @endforeach
        </select>
        <button type="submit">Tambahkan</button>
    </form>
</div>
@endsection
