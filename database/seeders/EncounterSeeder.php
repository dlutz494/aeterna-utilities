<?php

namespace Database\Seeders;

use App\Models\Encounter;
use Illuminate\Database\Seeder;

class EncounterSeeder extends Seeder
{
    public function run(): void
    {
        $encounterInfoOne   = [
            'Skeletons' => 'A group of skeletons shamble nearby.',
            'Bandits'   => 'A gang of bandits attempt to rob you.',
            'Pirates'   => 'Pirates have sailed nearby.',
        ];
        $encounterInfoTwo   = [
            'Knights' => 'A company of knights stop you on the road',
            'Wizards' => 'A wizard challenges you to a magic duel',
            'Nobles'  => 'You\'ve been accosted by a local noble',
        ];
        $encounterInfoThree = [
            'Wildlife' => 'A wild deer is along your path.',
            'Lich'     => 'A powerful lich suddenly appears.',
        ];

        foreach ($encounterInfoOne as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
                'context'     => 'First Place',
            ]);
        }
        foreach ($encounterInfoTwo as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
                'context'     => 'Second Place',
            ]);
        }
        foreach ($encounterInfoThree as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
                'context'     => null,
            ]);
        }
    }
}
