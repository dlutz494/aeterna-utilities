<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContextFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->text('20'),
        ];
    }
}
