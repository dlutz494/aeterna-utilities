<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EncounterFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'       => $this->faker->text(20),
            'description' => $this->faker->realTextBetween(100),
        ];
    }
}
