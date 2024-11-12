@extends('components.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold capitalize">Selamat Datang, {{ Auth::user()->username }}</h1>
        <h2 class="text-xl mt-2 capitalize">Dashboard Utama {{ Auth::user()->role }}</h2>
    </div>

    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-4">Portal Informasi Akademik</h2>
        <p class="mb-4">Selamat datang di Portal Informasi Akademik. Aplikasi ini menyediakan akses bagi Anda untuk memantau aktivitas akademik dan kegiatan pembelajaran di kampus.</p>
        <div class="bg-yellow-100 p-4 rounded-lg mb-4">
            <h3 class="font-semibold">Catatan Penting</h3>
            <p>Jika terdapat perbedaan data yang ditampilkan dalam aplikasi ini, pastikan untuk merujuk pada data resmi yang tercatat di bagian Administrasi atau bagian Keuangan.</p>
        </div>
        <p>Untuk informasi lebih lanjut, silakan baca panduan penggunaan <a href="#" class="text-blue-500 underline">di sini</a>.</p>
    </div>

    <div class="bg-blue-50 p-6 mt-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-4">Survey Kepuasan Pengguna</h2>
        <p class="mb-4">Kami menghargai pendapat Anda. Mohon luangkan waktu untuk mengisi survei kepuasan terhadap layanan yang kami sediakan. Hasil survei ini akan membantu kami meningkatkan kualitas layanan untuk seluruh pengguna.</p>
    </div>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-lg font-semibold mb-2">Info Akademik</h3>
            <p>Kumpulan informasi akademik dan kegiatan pembelajaran di kampus.</p>
            <a href="#" class="text-blue-500 underline mt-2 inline-block">Selengkapnya</a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-lg font-semibold mb-2">Info Keuangan</h3>
            <p>Informasi terkait keuangan dan pembayaran yang perlu diperhatikan.</p>
            <a href="#" class="text-blue-500 underline mt-2 inline-block">Selengkapnya</a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-lg font-semibold mb-2">Info Kegiatan Kampus</h3>
            <p>Informasi kegiatan kampus, beasiswa, dan organisasi mahasiswa.</p>
            <a href="#" class="text-blue-500 underline mt-2 inline-block">Selengkapnya</a>
        </div>
    </div>
</div>
@endsection