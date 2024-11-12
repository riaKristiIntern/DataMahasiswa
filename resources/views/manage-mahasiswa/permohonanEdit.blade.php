@extends('components.layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Permohonan Edit Data Mahasiswa</h1>

    <div class="bg-white shadow-md rounded-lg p-4">
        @if($permohonan->isEmpty())
        <p>Tidak ada permohonan edit saat ini</p>
        @else
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Kelas</th>
                    <th class="border px-4 py-2">Nama Mahasiswa</th>
                    <th class="border px-4 py-2">Keterangan</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($permohonan as $request)
                <tr class="bg-white border-b text-center">
                    <td class="border px-4 py-2">{{ $request->kelas->name ?? 'Belum Terdaftar' }}</td>
                    <td class="border px-4 py-2">{{ $request->mahasiswa->name }}</td>
                    <td class="border px-4 py-2">{{ $request->keterangan }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('dosen.approveRequest', $request->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Setujui</button>
                        </form>
                        <form action="{{ route('dosen.rejectRequest', $request->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Tolak</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection