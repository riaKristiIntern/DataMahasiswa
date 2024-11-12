@extends('components.layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Profil {{ auth()->user()->mahasiswa->name }}</h1>

    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="relative overflow-x-auto">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-2xl font-bold mb-4">Data Diri</h4>

                <form action="{{ route('mahasiswa.requestEditForm') }}" method="GET" class="inline-block float-end">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
                        Ajukan Edit Data
                    </button>
                </form>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            NIM
                        </th>
                        <td class="px-6 py-4">
                            : {{ auth()->user()->mahasiswa->nim }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Nama Lengkap
                        </th>
                        <td class="px-6 py-4">
                            : {{ auth()->user()->mahasiswa->name }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Tempat Lahir
                        </th>
                        <td class="px-6 py-4">
                            : {{ auth()->user()->mahasiswa->tempat_lahir }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Tanggal Lahir
                        </th>
                        <td class="px-6 py-4">
                            : {{ auth()->user()->mahasiswa->tanggal_lahir->format('d-m-Y') }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Kelas
                        </th>
                        <td class="px-6 py-4">
                            : {{ auth()->user()->mahasiswa->kelas->name ?? 'Belum Terdaftar' }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Username
                        </th>
                        <td class="px-6 py-4">
                            : {{ auth()->user()->username }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Email
                        </th>
                        <td class="px-6 py-4">
                            : {{ auth()->user()->email }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Status Edit
                        </th>
                        <td class="px-6 py-4">
                            : {{ auth()->user()->mahasiswa->edit ? 'Menunggu' : 'Tidak ada permohonan' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Hanya menampilkan form edit jika izin diberikan -->
    @if(auth()->user()->mahasiswa->edit === 1)
    <div class="bg-white shadow-md rounded-lg p-4 mt-4">
        <h2 class="text-xl font-bold mb-4">Edit Profil</h2>
        <form action="{{ route('mahasiswa.saveEdit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ auth()->user()->mahasiswa->name }}" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label for="tempat_lahir" class="block text-gray-700 font-bold mb-2">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ auth()->user()->mahasiswa->tempat_lahir }}" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label for="tanggal_lahir" class="block text-gray-700 font-bold mb-2">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ auth()->user()->mahasiswa->tanggal_lahir->format('Y-m-d') }}" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                <input type="text" name="username" value="{{ auth()->user()->username }}" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full px-3 py-2 border rounded-lg">
            </div>

            <button type="submit"
                class="px-4 py-2 rounded mt-2 bg-blue-500 text-white">
                Simpan Perubahan
            </button>
        </form>
    </div>
    @else
    <div class="bg-gray-100 shadow-md rounded-lg p-4 mt-4">
        <p class="text-gray-500">Anda belum diizinkan untuk mengedit data. Ajukan permohonan ke dosen wali Anda!</p>
    </div>
    @endif
</div>
</div>

<!-- pop up message -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('
        success ') }}'
    });
</script>
@elseif(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('
        error ') }}'
    });
</script>
@endif -->

@endsection