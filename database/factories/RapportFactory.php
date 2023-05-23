<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rapport>
 */
class RapportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1,5),
            'objet' => $this->faker->jobTitle(),
            'type' => $this->faker->randomElement(['mission','courrier']),
            'contenu' => $this->faker->sentence(6),
        ];
    }
}
