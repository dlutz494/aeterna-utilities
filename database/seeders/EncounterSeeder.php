<?php

namespace Database\Seeders;

use App\Models\Context;
use App\Models\Encounter;
use Illuminate\Database\Seeder;

class EncounterSeeder extends Seeder
{
    public function run(): void
    {
        // Forest encounters
        $forestContext    = Context::find(1);
        $forestEncounters = [
            'Pond'       => 'You come across an opening in the forest surrounding an inviting pond.',
            'Elk'        => 'A lone elk is seen grazing nearby.',
            'Black Bear' => 'The roar of a great black bear cuts through the ambient chirping of birds as it emerges from the brush in front of you, ready to attack.',
        ];
        foreach ($forestEncounters as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
            ])->contexts()->attach($forestContext, [
                'weight' => rand(5, 20),
            ]);
        }

        // Desert encounters
        $desertContext    = Context::find(2);
        $desertEncounters = [
            'Sand Storm'  => 'The wind picks up and the sands begin to swirl into a powerful dust tornado.',
            'Scorpions'   => 'A large body of scorpions emerges from the sand around you.',
            'Giant Worms' => 'Sand moves nearby and a giant worm springs out to attack.',
        ];
        foreach ($desertEncounters as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
            ])->contexts()->attach($desertContext, [
                'weight' => rand(5, 20),
            ]);
        }

        // Tundra encounters
        $tundraContext    = Context::find(3);
        $tundraEncounters = [
            'Polar Bear'      => 'A mound of snow blows away from the high winds and a hungry polar bear emerges.',
            'Snow Storm'      => 'The wind picks up and you feel the snow and ice begin to cut your flesh.',
            'Frost Elemental' => 'A living embodiment of the region\'s climate forms to protect it from unwanted intrusions.',
        ];
        foreach ($tundraEncounters as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
            ])->contexts()->attach($tundraContext, [
                'weight' => rand(5, 20),
            ]);
        }

        // Urban encounters
        $urbanContext    = Context::find(4);
        $urbanEncounters = [
            'Guards'         => 'A couple guards command you to halt as you walk down the street',
            'Knight Company' => 'A company of knights stop you on the road',
            'Thieves Ambush' => 'A gang of thieves have stolen your gold pouch from under your nose.',
            'Wizard Duel'    => 'A wizard challenges you to a magic duel',
            'Nobles'         => 'You\'ve been accosted by a local noble',
        ];
        foreach ($urbanEncounters as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
            ])->contexts()->attach($urbanContext, [
                'weight' => rand(5, 20),
            ]);
        }

        // Mixed encounters
        $forestTundraEncounters = [
            'Wolves' => 'A pack of wolves have surrounded you.',
        ];
        foreach ($forestTundraEncounters as $title => $description) {
            $encounter = Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
            ]);
            $encounter->contexts()->attach($forestContext, [
                'weight' => rand(5, 20),
            ]);
            $encounter->contexts()->attach($tundraContext, [
                'weight' => rand(5, 20),
            ]);
        }
        $forestDesertEncounters = [
            'Skeletons' => 'A group of skeletons shamble nearby.',
        ];
        foreach ($forestDesertEncounters as $title => $description) {
            $encounter = Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
            ]);
            $encounter->contexts()->attach($forestContext, [
                'weight' => rand(5, 20),
            ]);
            $encounter->contexts()->attach($desertContext, [
                'weight' => rand(5, 20),
            ]);
        }
        $forestUrbanEncounters = [
            'Bandits' => 'A gang of bandits attempt to rob you.',
        ];
        foreach ($forestUrbanEncounters as $title => $description) {
            $encounter = Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
            ]);
            $encounter->contexts()->attach($forestContext, [
                'weight' => rand(5, 20),
            ]);
            $encounter->contexts()->attach($urbanContext, [
                'weight' => rand(5, 20),
            ]);
        }

        // Anywhere encounters
        $anywhereEncounters = [
            'Guardian Angel' => 'A blinding golden light heralds the appearance of a divine saviour - a guardian angel.',
            'Lich'           => 'A powerful lich appears from out of a black cloud.',
        ];
        foreach ($anywhereEncounters as $title => $description) {
            Encounter::factory()->create([
                'title'       => $title,
                'description' => $description,
            ])->contextEncounters()->create([
                'weight' => 1,
            ]);
        }
    }
}
