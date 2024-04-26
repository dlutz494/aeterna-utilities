<?php

namespace Database\Seeders;

use App\Models\Context;
use App\Models\Encounter;
use Illuminate\Database\Seeder;

class EncounterSeeder extends Seeder
{
    public function run(): void
    {
        $forestEncounters   = [
            'Bandits'   => 'A gang of bandits attempt to rob you.',
            'Wolves'    => 'A pack of wolves have surrounded you.',
            'Skeletons' => 'A group of skeletons shamble nearby.',
        ];
        $desertEncounters   = [
            'Scorpions'   => 'A large body of scorpions emerges from the sand around you.',
            'Giant Worms' => 'Sand moves nearby and a giant worm springs out to attack.',
            'Skeletons'   => 'A pharaoh and their servants from a long-dead civilizations arise from their sandy graves.',
        ];
        $tundraEncounters   = [
            'Wolves'          => 'A pack of wolves have surrounded you.',
            'Frost Elemental' => 'A living embodiment of the region\'s climate forms to protect it from unwanted intrusions.',
        ];
        $urbanEncounters    = [
            'Guards'  => 'A couple guards command you to halt as you walk down the street',
            'Knights' => 'A company of knights stop you on the road',
            'Thieves' => 'A gang of thieves have stolen your gold pouch from under your nose.',
            'Wizards' => 'A wizard challenges you to a magic duel',
            'Nobles'  => 'You\'ve been accosted by a local noble',
        ];
        $anywhereEncounters = [
            'Lich' => 'A powerful lich appears from out of a black cloud.',
        ];

        foreach ($forestEncounters as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
            ])->contexts()->attach(Context::find(1), [
                'weight' => rand(2, 10),
            ]);
        }
        foreach ($desertEncounters as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
            ])->contexts()->attach(Context::find(2), [
                'weight' => rand(2, 10),
            ]);
        }
        foreach ($tundraEncounters as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
            ])->contexts()->attach(Context::find(3), [
                'weight' => rand(2, 10),
            ]);
        }
        foreach ($urbanEncounters as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
            ])->contexts()->attach(Context::find(4), [
                'weight' => rand(2, 10),
            ]);
        }
        foreach ($anywhereEncounters as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
            ])->contextEncounter()->create([
                'weight' => 1,
            ]);
        }
    }
}
