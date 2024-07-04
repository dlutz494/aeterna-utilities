<?php

namespace Tests\Feature\EncounterController;

use App\Models\Context;
use App\Models\Encounter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoDeleteTest extends TestCase
{
    use RefreshDatabase;

    public string $route = 'encounter.doDelete';
    public Encounter $encounter;

    public function test_it_redirects_to_encounter_index(): void
    {
        $this->delete(route($this->route, $this->encounter))->assertRedirect(route('encounter.index'));
    }

    public function test_it_deletes_an_encounter(): void
    {
        $this->delete(route($this->route, $this->encounter));

        $this->assertDatabaseCount('encounters', 0);
        $this->assertDatabaseMissing('encounters', [
            'title'       => $this->encounter->title,
            'description' => $this->encounter->description,
        ]);
    }

    public function test_it_deletes_related_context_encounters(): void
    {
        $this->delete(route($this->route, $this->encounter));

        $this->assertDatabaseCount('context_encounters', 0);
        $this->assertDatabaseMissing('context_encounters', [
            'encounter_id' => $this->encounter->getKey(),
            'context_id'   => 1,
            'weight'       => 10,
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->encounter = Encounter::factory()->create([
            'title' => 'Existing Encounter Title',
        ]);
        $this->encounter->contextEncounters()->create([
            'weight'     => 10,
            'context_id' => Context::factory()->create()->getKey(),
        ]);
        $this->encounter->save();
    }
}
