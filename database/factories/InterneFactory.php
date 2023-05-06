<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interne>
 */
class InterneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference' => uniqid(),
            'objet' => $this->faker->sentence(2),
            'nature_id' => rand(1,5),
            'user_id' => rand(1,5),
            'expediteur_id' => rand(1,5),
            'destinataire_id' => rand(1,5),
            'numero' => uniqid(),
            'priorite' => $this->faker->randomElement(['Normal','Urgent']),
            'confidentiel' => $this->faker->randomElement(['OUI','NON']),
            'etat' => $this->faker->randomElement(['foo','bar']),
        ];
    }
}
