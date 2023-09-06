<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Depart>
 */
class DepartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'objet' => $this->faker->sentence(2),
            'structure_id' => rand(1, 5),
            'nature_id' => rand(1, 5),
            'user_id' => rand(1, 5),
            'initiateur_id' => rand(1, 5),
            'numero' => uniqid(),
            'priorite' => $this->faker->randomElement(['Normal', 'Urgent']),
            'confidentiel' => $this->faker->randomElement(['OUI', 'NON']),
            'date' => $this->faker->date(),
            'etat' => $this->faker->randomElement(['Enregistré', 'Envoyé']),
        ];
    }
}
