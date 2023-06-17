<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Posko;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posko>
 */
class PoskoFactory extends Factory
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
            'provinsi' => $this->faker->state(),
            'kota' => $this->faker->city(),
            'kecamatan' => $this->faker->citySuffix(),
            'kelurahan' => $this->faker->cityPrefix(),
            'detail' => $this->faker->streetSuffix(),
            'kapasitas' => $this->faker->numberBetween(0, 100)
        ];
    }
}
