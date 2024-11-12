@extends('components.layout')

@section('title', 'Profile')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Profil {{ $kaprodi->name }}</h1>

    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="relative overflow-x-auto">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-2xl font-bold mb-4">Data Diri</h4>
                <a href="{{ route('kaprodi.edit') }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Edit Data Diri</a>
            </div>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Kode Dosen
                    </th>
                    <td class="px-6 py-4">
                        : {{ $kaprodi->kode_dosen }}
                    </td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        NIP
                    </th>
                    <td class="px-6 py-4">
                        : {{ $kaprodi->nip }}
                    </td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Nama Lengkap
                    </th>
                    <td class="px-6 py-4">
                        : {{ $kaprodi->name }}
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
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection