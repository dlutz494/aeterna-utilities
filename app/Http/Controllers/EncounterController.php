<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEncounterRequest;
use App\Http\Requests\EditEncounterRequest;
use App\Models\Encounter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EncounterController extends Controller
{
    public function doCreate(CreateEncounterRequest $request): RedirectResponse
    {
        Encounter::factory()->create($request->validated());

        return to_route('generator');
    }

    public function create(): Response
    {
        return Inertia::render('EncounterGenerator/CreateEncounter');
    }

    public function doDelete(Request $request, Encounter $encounter): RedirectResponse
    {
        $encounter->delete();

        return to_route('generator');
    }

    public function edit(Encounter $encounter): Response
    {
        return Inertia::render(
            'EncounterGenerator/EditEncounter',
            [
                'encounter' => $encounter,
            ]
        );
    }

    public function doEdit(EditEncounterRequest $request, Encounter $encounter): RedirectResponse
    {
        $encounter->update($request->validated());

        return to_route('generator');
    }
}
