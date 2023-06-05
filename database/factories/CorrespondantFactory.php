<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Correspondant>
 */
class CorrespondantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->firstName(),
            'structure_id' => rand(1,5),
            'nom' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'fonction' => $this->faker->jobTitle(),
            'contact' => $this->faker->phoneNumber(),
        ];
    }
}
