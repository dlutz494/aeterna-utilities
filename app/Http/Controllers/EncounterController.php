<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEncounterRequest;
use App\Http\Requests\EditEncounterRequest;
use App\Models\Context;
use App\Models\Encounter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
                'context'     => Context::find($encounter->context_id),
                'edit_url'    => route('encounter.edit', $encounter->id),
                'delete_url'  => route('encounter.delete', $encounter->id),
            ];
        });

        return Inertia::render(
            'EncounterGenerator/EncounterIndex',
            [
                'encounters' => $encounterData,
                'create_url' => route('encounter.create'),
            ]
        );
    }

    public function doCreate(CreateEncounterRequest $request): RedirectResponse
    {
        Encounter::factory()->create($request->validated());

        return to_route('encounter.index');
    }

    public function create(): Response
    {
        return Inertia::render(
            'EncounterGenerator/CreateEncounter',
            [
                'contexts' => Context::all(),
            ]
        );
    }

    public function doDelete(Request $request, Encounter $encounter): RedirectResponse
    {
        $encounter->delete();

        return to_route('encounter.index');
    }

    public function edit(Encounter $encounter): Response
    {
        return Inertia::render(
            'EncounterGenerator/EditEncounter',
            [
                'encounter' => $encounter,
                'contexts'  => Context::all(),
            ]
        );
    }

    public function doEdit(EditEncounterRequest $request, Encounter $encounter): RedirectResponse
    {
        $encounter->update($request->validated());

        return to_route('encounter.index');
    }
}
