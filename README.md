# DataMahasiswa

# Aplikasi Sistem Akademik Mahasiswa

Aplikasi sistem akademik mahasiswa ini dirancang untuk mengelola data mahasiswa, dosen, dan kelas dalam suatu institusi pendidikan. Sistem ini membedakan peran antara Kaprodi, Dosen, dan Mahasiswa dengan kemampuan akses dan manipulasi data yang berbeda-beda sesuai dengan peran masing-masing.

## Deskripsi
Aplikasi ini memiliki beberapa peran dan fungsionalitas yang dirancang untuk memudahkan pengelolaan data akademik. Berikut adalah deskripsi peran-peran dalam aplikasi ini:

- **Login dengan Role-based Access Control**: Sistem login membedakan peran (Kaprodi, Dosen, Mahasiswa) dengan akses yang berbeda-beda.
- **Kaprodi**: Memiliki akses penuh untuk mengelola data dosen dan kelas.
- **Dosen**: Dosen wali dapat mengelola mahasiswa di kelas mereka, menyetujui atau menolak permintaan perubahan data mahasiswa.
- **Mahasiswa**: Mahasiswa hanya dapat mengakses dan mengedit data mereka sendiri dengan izin dari dosen wali mereka.
- **Data Dummy**: Terdapat data dummy untuk 1 Kaprodi, 5 Dosen (termasuk 2 dosen wali), dan 20 Mahasiswa yang dibagi dalam 2 kelas dengan masing-masing 10 mahasiswa.
  
## Prasyarat
- PHP >= 8.0
- Composer
- Laravel 10
- SQlite
- Tailwind CSS

##Relasi Database
Struktur dan relasi antar tabel dalam aplikasi ini bisa dilihat pada diagram database berikut:

[Diagram Database – Sistem Akademik Mahasiswa](https://dbdiagram.io/d/Data-Mahasiswa-66a99f438b4bb5230eccaaef)

## Instalasi

1. Clone repository ini:
   ```bash
   git clone https://github.com/username/repository.git
   ```
3. Masuk ke direktori proyek:
   ```bash
   cd nama-proyek
   ```
5. Install dependencies dengan Composer:
   ```bash
   composer install
   ```
7. Generate key aplikasi Laravel:
   ```bash
   php artisan key:generate
   ```
9. Sesuaikan konfigurasi database di file .env, lalu jalankan migrasi database:
   ```bash
   php artisan migrate
   ```
11. Jalankan server lokal:
    ```bash
    php artisan serve
    ```

##Penggunaan
Setelah aplikasi berjalan di server lokal, kita dapat langsung mengaksesnya dan login menggunakan salah satu dari akun berikut:

####Login sebagai Kaprodi
Email: kasiyah00@yahoo.com
Password: password123

####Login sebagai Dosen Wali
Email: lega48@gmail.com
Password: password123

####Login sebagai Dosen Biasa
Email: gamani25@gmail.com
Password: password123

####Login sebagai Mahasiswa
Email: imam09@yahoo.co.id
Password: password123
