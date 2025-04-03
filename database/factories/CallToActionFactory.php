<?php

namespace Database\Factories;

use App\Models\CallToAction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CallToAction>
 */
class CallToActionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(mt_rand(3, 5)),
            'description' => $this->faker->sentence(mt_rand(8, 12)),
            'button_text' => $this->faker->words(mt_rand(1, 3), true),
            'button_url' => $this->faker->url(),
            'button_text_color' => $this->faker->hexColor(),
            'button_bg_color' => $this->faker->hexColor(),
        ];
    }
}