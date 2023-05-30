<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['Arrivé','Depart','Interne','rapport']),
            'documentable_type' => $this->faker->randomElement(['App\Models\Courrier','App\Models\Depart','App\Models\Interne']),
            'documentable_id' => rand(1,15),
            'user_id' => rand(1,10),
            'chemin' => $this->faker->imageUrl(),
            'libelle' => $this->faker->name(),
        ];
    }
}
