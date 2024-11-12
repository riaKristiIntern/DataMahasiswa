<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Inisialisasi Faker dengan locale Indonesia

        // Buat kelas A dan B
        $kelasA = Kelas::create(['name' => 'A']);
        $kelasB = Kelas::create(['name' => 'B']);

        // Membuat Kaprodi
        $kaprodiUser = User::factory()->create([
            'role' => 'kaprodi',
            'username' => $faker->userName,
            'email' => $faker->email,
            'password' => Hash::make('password123'),
        ]);

        // Insert data into kaprodi table
        Kaprodi::create([
            'user_id' => $kaprodiUser->id,
            'kode_dosen' => $faker->unique()->numerify('KD###'),
            'nip' => $faker->unique()->numerify('########'),
            'name' => $faker->name,
        ]);

        // Membuat Dosen Wali
        foreach (range(1, 2) as $index) {
            $dosenWaliUser = User::factory()->create([
                'role' => 'dosen wali',
                'username' => $faker->userName,
                'email' => $faker->email,
                'password' => Hash::make('password123'),
            ]);

            // Insert data into dosen table (dosen wali)
            Dosen::create([
                'user_id' => $dosenWaliUser->id,
                'kode_dosen' => $faker->unique()->numerify('####'),
                'nip' => $faker->unique()->numerify('########'),
                'name' => $faker->name,
                'kelas_id' => $index == 1 ? $kelasA->id : $kelasB->id, // Assigning a class
            ]);
        }

        // Membuat Dosen Biasa
        foreach (range(1, 3) as $index) {
            $dosenUser = User::factory()->create([
                'role' => 'dosen',
                'username' => $faker->userName,
                'email' => $faker->email,
                'password' => Hash::make('password123'),
            ]);
            // Insert data into dosen table (dosen biasa)
            Dosen::create([
                'user_id' => $dosenUser->id,
                'kode_dosen' => $faker->unique()->numerify('####'),
                'nip' => $faker->unique()->numerify('########'),
                'name' => $faker->name,
                'kelas_id' => null, // No class assigned yet
            ]);
        }

        // Membuat Mahasiswa
        foreach (range(1, 20) as $index) {
            $kelas = null;

            // Mengatur kelas untuk 7 mahasiswa di kelas A dan 5 mahasiswa di kelas B
            if ($index <= 7) {
                $kelas = $kelasA->id; // Menggunakan ID kelas A
            } elseif ($index <= 12) {
                $kelas = $kelasB->id; // Menggunakan ID kelas B
            }

            $mahasiswaUser = User::factory()->create([
                'role' => 'mahasiswa',
                'username' => $faker->userName,
                'email' => $faker->email,
                'password' => Hash::make('password123'),
            ]);

            // Simpan mahasiswa dengan kelas jika ada
            Mahasiswa::create([
                'user_id' => $mahasiswaUser->id,
                'kelas_id' => $kelas, // Pastikan kelas_id mengacu pada kelas yang sesuai
                'nim' => $faker->unique()->numerify('########'),
                'name' => $faker->name,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date(),
            ]);
        }
    }
}
