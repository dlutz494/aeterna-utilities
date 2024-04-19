<?php

namespace Database\Factories;

use App\Models\Context;
use App\Models\Encounter;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightFactory extends Factory
{
    public function definition(): array
    {
        return [
            'context_id'   => Context::factory(),
            'encounter_id' => Encounter::factory(),
            'weight'       => 1,
        ];
    }
}
