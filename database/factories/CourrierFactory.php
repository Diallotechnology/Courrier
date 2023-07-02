<?php

namespace Database\Factories;

use App\Enum\CourrierEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courrier>
 */
class CourrierFactory extends Factory
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
            'correspondant_id' => rand(1, 5),
            'nature_id' => rand(1, 5),
            'structure_id' => rand(1, 5),
            'user_id' => rand(1, 5),
            'numero' => uniqid(),
            'priorite' => $this->faker->randomElement(['Normal', 'Urgent']),
            'confidentiel' => $this->faker->randomElement(['OUI', 'NON']),
            'date' => $this->faker->date(),
            'created_at' => $this->faker->dateTimeInInterval('0 years', '+8 days'),
            'etat' => $this->faker->randomElement(CourrierEnum::cases()),
        ];
    }
}
