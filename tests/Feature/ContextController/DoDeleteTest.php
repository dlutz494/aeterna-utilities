<?php

namespace Tests\Feature\ContextController;

use App\Models\Context;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoDeleteTest extends TestCase
{
    use RefreshDatabase;

    public string $route = 'context.doDelete';
    public Context $context;

    public function test_it_redirects_to_context_index(): void
    {
        $this->delete(route($this->route, $this->context))->assertRedirect(route('context.index'));
    }

    public function test_it_deletes_a_context(): void
    {
        $this->delete(route($this->route, $this->context));

        $this->assertDatabaseCount('contexts', 0);
        $this->assertDatabaseMissing('contexts', [
            'title' => $this->context->title,
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->context = Context::factory()->create([
            'title' => 'Existing Context Title',
        ]);
    }
}
