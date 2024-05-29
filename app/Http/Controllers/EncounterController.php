<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEncounterRequest;
use App\Http\Requests\EditEncounterRequest;
use App\Models\Context;
use App\Models\Encounter;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class EncounterController extends Controller
{
    public function index(): Response
    {
        $encounterData = Encounter::all()->map(function ($encounter) {
            return [
                'id'          => $encounter->id,
                'title'       => $encounter->title,
                'description' => $encounter->description,
                'contexts'    => $encounter->contexts ?? null,
                'weight'      => $encounter->weight,
                'edit_url'    => route('encounter.edit', $encounter),
                'delete_url'  => route('encounter.delete', $encounter),
            ];
        });

        return Inertia::render(
            'Admin/EncounterIndex',
            [
                'encounters' => $encounterData,
                'create_url' => route('encounter.create'),
            ]
        );
    }

    public function doCreate(CreateEncounterRequest $request): RedirectResponse
    {
        $encounter = Encounter::factory()->create($request->safe()->only([
            'title',
            'description',
        ]));

        if ($request->has('context_id')) {
            $encounter->contextEncounter()->create([
                'weight'     => $request->validated('weight'),
                'context_id' => $request->validated('context_id'),
            ]);
        } else {
            $encounter->contextEncounter()->create([
                'weight' => $request->validated('weight'),
            ]);
        }

        return to_route('encounter.index');
    }

    public function create(): Response
    {
        return Inertia::render(
            'Admin/CreateEncounter',
            [
                'contexts' => Context::all(),
            ]
        );
    }

    public function doDelete(Encounter $encounter): RedirectResponse
    {
        $encounter->delete();

        return to_route('encounter.index');
    }

    public function edit(Encounter $encounter): Response
    {
        return Inertia::render(
            'Admin/EditEncounter',
            [
                'encounter' => $encounter,
                'context'   => $encounter->contexts[0] ?? null,
                'weight'    => $encounter->weight,
                'contexts'  => Context::all(),
            ]
        );
    }

    public function doEdit(EditEncounterRequest $request, Encounter $encounter): RedirectResponse
    {
        $encounter->update($request->safe()->only([
            'title',
            'description',
        ]));

        if ($request->has(['weight', 'context_id'])) {
            $encounter->contextEncounter()->update([
                'weight'     => $request->validated('weight'),
                'context_id' => $request->validated('context_id'),
            ]);
        } elseif ($request->has('weight')) {
            $encounter->contextEncounter()->update([
                'weight' => $request->validated('weight'),
            ]);
        }

        return to_route('encounter.index');
    }
}
