<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubDepartement>
 */
class SubDepartementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'departement_id' => rand(1, 5),
            'nom' => $this->faker->company(),
            'code' => $this->faker->companySuffix(),
        ];
    }
}
