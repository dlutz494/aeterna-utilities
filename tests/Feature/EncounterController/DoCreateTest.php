<?php

namespace Tests\Feature\EncounterController;

use App\Http\Requests\CreateEncounterRequest;
use App\Models\Context;
use App\Models\Encounter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoCreateTest extends TestCase
{
    use RefreshDatabase;

    public string $route = 'encounter.doCreate';

    public static function ProvidesInvalidRequests(): array
    {
        $validRequest = [
            'title'       => 'Encounter Title',
            'description' => 'This is an encounter description',
            'contexts'    => [1, 2, 3],
            'weights'     => [10, 5, 1],
        ];

        return [
            'title.required'       => [
                'request'   => [
                    ...$validRequest,
                    'title' => null,
                ],
                'exception' => [
                    'title' => [
                        'A Title is needed',
                    ],
                ],
            ],
            'title.string'         => [
                'request'   => [
                    ...$validRequest,
                    'title' => 1,
                ],
                'exception' => [
                    'title' => [
                        'The Title has to be a string',
                    ],
                ],
            ],
            'title.unique'         => [
                'request'   => [
                    ...$validRequest,
                    'title' => 'Existing Encounter Title',
                ],
                'exception' => [
                    'title' => [
                        'That Title is already in use',
                    ],
                ],
            ],
            'title.max'            => [
                'request'   => [
                    ...$validRequest,
                    'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla lectus odio, malesuada vitae commodo vitae, commodo laoreet leo. Quisque vitae neque vitae mi aliquet aliquam a ultrices dolor. Donec placerat finibus urna eu vestibulum. Vivamus ligula diam, tristique id sagittis ut, sagittis ac dui. Donec non convallis urna. Aliquam sit.',
                ],
                'exception' => [
                    'title' => [
                        'That Title is too long (Maximum ' . CreateEncounterRequest::MAX_TITLE_LENGTH . ' Characters)',
                    ],
                ],
            ],
            'description.required' => [
                'request'   => [
                    ...$validRequest,
                    'description' => null,
                ],
                'exception' => [
                    'description' => [
                        'A Description is needed',
                    ],
                ],
            ],
            'description.string'   => [
                'request'   => [
                    ...$validRequest,
                    'description' => 1,
                ],
                'exception' => [
                    'description' => [
                        'The Description has to be a string',
                    ],
                ],
            ],
            'contexts.array'       => [
                'request'   => [
                    ...$validRequest,
                    'contexts' => 1,
                ],
                'exception' => [
                    'contexts' => [
                        'Contexts need to be in array form',
                    ],
                ],
            ],
            'contexts.*.exists'    => [
                'request'   => [
                    ...$validRequest,
                    'contexts' => [4],
                ],
                'exception' => [
                    'contexts.0' => [
                        'That Context does not exist',
                    ],
                ],
            ],
            'contexts.*.distinct'  => [
                'request'   => [
                    ...$validRequest,
                    'contexts' => [1, 1],
                ],
                'exception' => [
                    'contexts.0' => [
                        'That Context is already selected',
                    ],
                    'contexts.1' => [
                        'That Context is already selected',
                    ],
                ],
            ],
            'weights'    => [
                'request'   => [
                    ...$validRequest,
                    'weights' => 10,
                ],
                'exception' => [
                    'weights' => [
                        'Weights need to be in array form',
                    ],
                ],
            ],
            'weights.0.required'    => [
                'request'   => [
                    ...$validRequest,
                    'weights' => [''],
                ],
                'exception' => [
                    'weights.0' => [
                        'A Weight is needed',
                    ],
                ],
            ],
            'weights.0.integer'    => [
                'request'   => [
                    ...$validRequest,
                    'weights' => ['ten'],
                ],
                'exception' => [
                    'weights.0' => [
                        'Weight has to be an integer',
                    ],
                ],
            ],
            'weights.0.min'    => [
                'request'   => [
                    ...$validRequest,
                    'weights' => [0],
                ],
                'exception' => [
                    'weights.0' => [
                        'Weight has to be greater than 0',
                    ],
                ],
            ],
        ];
    }

    public function test_it_redirects_to_encounter_index(): void
    {
        $request = [
            'title'       => 'Encounter Title',
            'description' => 'This is an encounter description',
            'contexts'    => [1],
            'weights'     => [10],
        ];

        $this->post(route($this->route), $request)->assertRedirect(route('encounter.index'));
    }

    public function test_it_creates_an_encounter(): void
    {
        $request = [
            'title'       => 'Encounter Title',
            'description' => 'This is an encounter description',
            'contexts'    => [1],
            'weights'     => [10],
        ];

        $this->post(route($this->route), $request);

        $this->assertDatabaseHas('encounters', [
            'title'       => $request['title'],
            'description' => $request['description'],
        ]);
    }

    public function test_it_creates_a_related_context_encounter(): void
    {
        $request = [
            'title'       => 'Encounter Title',
            'description' => 'This is an encounter description',
            'contexts'    => [1],
            'weights'     => [10],
        ];

        $this->post(route($this->route), $request);

        $this->assertDatabaseHas('context_encounters', [
            'context_id' => $request['contexts'][0],
            'weight'     => $request['weights'][0],
        ]);
    }

    public function test_it_creates_an_encounter_with_no_context(): void
    {
        $request = [
            'title'       => 'Encounter Title',
            'description' => 'This is an encounter description',
            'weights'     => [10],
        ];

        $this->post(route($this->route), $request);

        $this->assertDatabaseHas('encounters', [
            'title'       => $request['title'],
            'description' => $request['description'],
        ]);
        $this->assertDatabaseHas('context_encounters', [
            'context_id' => null,
            'weight'     => $request['weights'][0],
        ]);
    }

    /**
     * @dataProvider ProvidesInvalidRequests
     */
    public function test_it_returns_validation_errors($request, $exception): void
    {
        $response = $this->post(route($this->route), $request);

        $response->assertInvalid($exception);
        $this->assertDatabaseCount('encounters', 1);
        $this->assertDatabaseMissing('encounters', ['id' => 2]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Context::factory(3)->create();
        Encounter::factory()->create([
            'title' => 'Existing Encounter Title',
        ]);
    }
}
