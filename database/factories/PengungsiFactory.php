<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengungsi>
 */
class PengungsiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->word(),
            'kplklg_id' => $this->faker->numberBetween(1,10),
            'telpon' => $this->faker->phoneNumber(),
            'provinsi' => $this->faker->state(),
            'kota' => $this->faker->city(),
            'kecamatan' => $this->faker->citySuffix(),
            'kelurahan' => $this->faker->cityPrefix(),
            'detail' => $this->faker->streetSuffix(),
            'gender' => $this->faker->numberBetween(0,1),
            'umur' => $this->faker->numberBetween(1,100),
            'statPos'=> $this->faker->numberBetween(0,1),
            'posko_id'=> $this->faker->numberBetween(0,1),
            'statKon'=> $this->faker->numberBetween(0,3),
        ];
    }
}
