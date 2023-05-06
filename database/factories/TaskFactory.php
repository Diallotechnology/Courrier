<?php

namespace Database\Factories;

use App\Enum\TaskEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
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
            'description' => $this->faker->sentence(2),
            'etat' => $this->faker->randomElement(TaskEnum::cases()),
            'type' => $this->faker->randomElement(['foo','bar']),
            'debut' => $this->faker->date(),
            'fin' => $this->faker->date(),
        ];
    }
}
