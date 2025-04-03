<?php

namespace Database\Factories;

use App\Models\QuizAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuizAnswer>
 */
class QuizAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => $this->faker->sentence(mt_rand(3, 6)),
            'is_correct' => false,
        ];
    }
    
    /**
     * Set the answer as correct.
     */
    public function correct(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'is_correct' => true,
            ];
        });
    }
}