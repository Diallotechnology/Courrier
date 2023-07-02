<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'data' => $this->faker->sentence,
            'notifiable_type' => "App\Models\User",
            'type' => 'imputation',
            'notifiable_id' => \rand(1, 5),
            // Autres propriétés de votre notification
        ];
    }
}
