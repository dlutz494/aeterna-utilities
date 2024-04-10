<?php

namespace Database\Seeders;

use App\Models\Context;
use Illuminate\Database\Seeder;

class ContextSeeder extends Seeder
{
    public function run(): void
    {
        $contexts = [
            'First Place',
            'Second Place',
        ];

        foreach ($contexts as $title) {
            Context::factory()->create([
                'title' => $title,
            ]);
        }
    }
}
