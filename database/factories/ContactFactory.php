<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>User::inRandomOrder()->first()->id,
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'subject' => fake()->sentence(3),
            'replay_status' => random_int(0,1),
            'message' => fake()->paragraph(),
            'is_read' => random_int(0,1),
            'is_starred' => random_int(0,1),
            'is_spam' => random_int(0,1),

        ];
    }
}
