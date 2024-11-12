<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kaprodi;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Faker\Factory as Faker;

// class DatabaseSeeder extends Seeder
// {
//     /**
//      * Seed the application's database.
//      */
//     public function run(): void
//     {
//         $this->call([
//             UsersSeeder::class,
//             MahasiswaSeeder::class,
//             KaprodiSeeder::class,
//         ]);
        
        
//         // Kelas
//         $kelas = Kelas::all();

//         // Dosen wali (2 dosen yang memiliki hak crud)
//         $dosenWali = User::factory(2)->create(['role' => 'dosen wali']);
//         foreach ($dosenWali as $index => $dosen) {
//             Dosen::create([
//                 'user_id' => $dosen->id,
//                 'kelas_id' => $kelas[$index]->id,
//                 'kode_dosen' => rand(1000, 9999),
//                 'nip' => rand(100000, 999999),
//                 'name' => $dosen->username, 
//             ]);
//         }

//         // Dosen biasa
//         $dosenBiasa = User::factory(3)->create(['role' => 'dosen']);
//         foreach ($dosenBiasa as $index => $dosen) {
//             Dosen::create([
//                 'user_id' => $dosen->id,
//                 'kelas_id' => null,
//                 'kode_dosen' => rand(1000, 9999),
//                 'nip' => rand(100000, 999999),
//                 'name' => $dosen->username, 
//             ]);
//         }
//     }

// }


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat kelas A dan B
        // Kelas::create(['name' => 'A']);
        // Kelas::create(['name' => 'B']);

        // Panggil UsersSeeder untuk mengisi data user
        $this->call(UsersSeeder::class);
    }
}
