<?php

namespace Tests\Feature\ContextController;

use App\Http\Requests\CreateContextRequest;
use App\Models\Context;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoCreateTest extends TestCase
{
    use RefreshDatabase;

    public string $route = 'context.doCreate';

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

        $this->post(route($this->route), $request)->assertRedirect(route('context.index'));
    }

    public function test_it_creates_a_context(): void
    {
        $request = [
            'title' => 'Context Title',
        ];

        $this->post(route($this->route), $request);

        $this->assertDatabaseHas('contexts', [
            'title' => $request['title'],
        ]);
    }

    /**
     * @dataProvider ProvidesInvalidRequests
     */
    public function test_it_returns_validation_errors($request, $exception): void
    {
        $response = $this->post(route($this->route), $request);

        $response->assertInvalid($exception);
        $this->assertDatabaseCount('contexts', 1);
        $this->assertDatabaseMissing('contexts', ['id' => 2]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Context::factory()->create([
            'title' => 'Existing Context Title',
        ]);
    }
}
