<?php

namespace Database\Seeders;

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
            'Scorpions'       => 'A large body of scorpions emerges from the sand around you.',
            'Giant Scorpions' => 'Sand moves nearby and giant scorpions spring out to attack.',
            'Skeletons'       => 'A pharaoh and their servants from a long-dead civilizations arise from their sandy graves.',
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
                'context_id'  => 1,
            ]);
        }
        foreach ($desertEncounters as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
                'context_id'  => 2,
            ]);
        }
        foreach ($tundraEncounters as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
                'context_id'  => 3,
            ]);
        }
        foreach ($urbanEncounters as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
                'context_id'  => 4,
            ]);
        }
        foreach ($anywhereEncounters as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
                'context_id'  => null,
            ]);
        }
    }
}
