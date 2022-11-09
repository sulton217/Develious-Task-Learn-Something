<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StokBarang>
 */
class StokBarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'nama' => $this->faker->name(),
            'jumlah' => $this->faker->numberBetween(1, 50),
            'kodebarang' => $this->faker->numberBetween(1, 100),
        ];
    }
}
