<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Folder>
 */
class FolderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['Courrier Arrivé', 'Courrier Depart', 'Courrier Interne', 'Rapport']),
            'folderable_type' => $this->faker->randomElement(['App\Models\Courrier', 'App\Models\Depart', 'App\Models\Interne', 'App\Models\Rapport']),
            'folderable_id' => rand(1, 15),
            'structure_id' => rand(1, 5),
            'nom' => $this->faker->name(),

        ];
    }
}
