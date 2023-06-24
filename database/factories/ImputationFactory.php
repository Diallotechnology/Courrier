<?php

namespace Database\Factories;

use App\Enum\ImputationEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Imputation>
 */
class ImputationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero' => uniqid(),
            'structure_id' => rand(1,5),
            'courrier_id' => rand(1,5),
            'user_id' => rand(1,5),
            'priorite' => $this->faker->randomElement(['Normal','Urgent']),
            'etat' => $this->faker->randomElement(ImputationEnum::cases()),
        ];
    }
}
