<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubStructure>
 */
class SubStructureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'structure_id' => rand(1,5),
            'nom' => $this->faker->company(),
            'logo' => $this->faker->imageUrl(),
            'email' => $this->faker->companyEmail(),
            'adresse' => $this->faker->address(),
            'contact' => $this->faker->phoneNumber(),
            'description' => $this->faker->sentence(2),
        ];
    }
}
