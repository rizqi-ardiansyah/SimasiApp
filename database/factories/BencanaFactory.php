<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bencana>
 */
class BencanaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->firstNameMale(),
            'tanggal' => $this->faker->date(),
            'waktu' => $this->faker->time(),
            'lokasi' => $this->faker->city(),
            // 'korban' => $this->faker->randomDigit(),
            // 'kerusakan' => $this->faker->sentence(),
            'status' => $this->faker->numberBetween(0,4),
            // 'posko_id' => $this->faker->numberBetween(11, 22)
        ];
    }
}
