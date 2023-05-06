<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Structure>
 */
class StructureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->company(),
            'logo' => $this->faker->imageUrl(),
            'email' => $this->faker->companyEmail(),
            'contact' => $this->faker->phoneNumber(),
            'description' => $this->faker->sentence(2),
        ];
    }
}
