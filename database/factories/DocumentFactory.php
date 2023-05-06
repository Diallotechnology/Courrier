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
            'documentable_type' => "App\Models\Courrier",
            'documentable_id' => rand(1,15),
            'chemin' => $this->faker->imageUrl(),
            'libelle' => $this->faker->name(),
        ];
    }
}
