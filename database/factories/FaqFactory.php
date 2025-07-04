<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question'=>[
                'en'=>$this->faker->sentence(6) . '?',
                'ar'=>$this->faker->sentence(6) . '?',
            ],
            'answer'=>[
                'en'=>$this->faker->paragraph(5),
                'ar'=>$this->faker->paragraph(5),
            ],
        ];
    }
}

// php artisan make:factory FaqFactory --model=Faq 