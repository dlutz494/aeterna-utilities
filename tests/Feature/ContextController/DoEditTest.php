<?php

namespace Tests\Feature\ContextController;

use App\Http\Requests\CreateContextRequest;
use App\Models\Context;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoEditTest extends TestCase
{
    use RefreshDatabase;

    public string $route = 'context.doEdit';
    public Context $context;

    public static function ProvidesInvalidRequests(): array
    {
        return [
            'title.required' => [
                'request'   => [
                    'title' => null,
                ],
                'exception' => [
                    'title' => [
                        'A Title is needed',
                    ],
                ],
            ],
            'title.string'   => [
                'request'   => [
                    'title' => 1,
                ],
                'exception' => [
                    'title' => [
                        'The Title has to be a string',
                    ],
                ],
            ],
            'title.unique'   => [
                'request'   => [
                    'title' => 'Existing Context Title',
                ],
                'exception' => [
                    'title' => [
                        'That Title is already in use',
                    ],
                ],
            ],
            'title.max'      => [
                'request'   => [
                    'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla lectus odio, malesuada vitae commodo vitae, commodo laoreet leo.',
                ],
                'exception' => [
                    'title' => [
                        'That Title is too long (Maximum ' . CreateContextRequest::MAX_TITLE_LENGTH . ' Characters)',
                    ],
                ],
            ],
        ];
    }

    public function test_it_redirects_to_context_index(): void
    {
        $request = [
            'title' => 'Context Title',
        ];

        $this->patch(route($this->route, $this->context), $request)->assertRedirect(route('context.index'));
    }

    public function test_it_updates_a_context(): void
    {
        $request = [
            'title' => 'Test Context Title',
        ];

        $this->patch(route($this->route, $this->context), $request);

        $this->assertDatabaseHas('contexts', [
            'title' => $request['title'],
        ]);
    }

    /**
     * @dataProvider ProvidesInvalidRequests
     */
    public function test_it_returns_validation_errors($request, $exception): void
    {
        $response = $this->patch(route($this->route, $this->context), $request);

        $response->assertInvalid($exception);
        $this->assertDatabaseCount('contexts', 2);
        $this->assertDatabaseMissing('contexts', ['id' => 3]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->context = Context::factory()->create([
            'title' => 'Context Title',
        ]);
        Context::factory()->create([
            'title' => 'Existing Context Title',
        ]);
    }
}
