<?php

namespace Database\Seeders;

use App\Models\Context;
use Illuminate\Database\Seeder;

class ContextSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Forest',
            'Desert',
            'Tundra',
            'Urban',
        ];

        foreach ($titles as $title) {
            Context::factory()->create([
                'title' => $title,
            ]);
        }
    }
}
