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
            'user_id' => rand(1, 10),
            'folder_id' => rand(1, 10),
            'extension' => $this->faker->randomElement(['pdf', 'png', 'doc']),
            'chemin' => $this->faker->imageUrl(),
            'libelle' => $this->faker->name(),
        ];
    }
}
