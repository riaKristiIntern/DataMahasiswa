<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\id_ID\Person as IdPerson;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Mahasiswa::class;

    public function definition(): array
    {
        $this->faker->addProvider(new IdPerson($this->faker));
        return [
            'user_id' => User::factory(),
            'kelas_id' => $this->faker->randomElement(kelas::pluck('id')->toArray()),
            'nim' => $this->faker->unique()->randomNumber(8),
            'name' => $this->faker->name,
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->dateTimeBetween('1998-01-01', '2004-12-31')->format('d-m-Y'),
            'edit' => false,
        ];
    }
}
