<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContextRequest;
use App\Http\Requests\EditContextRequest;
use App\Models\Context;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContextController extends Controller
{
    public function doCreate(CreateContextRequest $request): RedirectResponse
    {
        Context::factory()->create($request->validated());

        return to_route('generator');
    }

    public function create(): Response
    {
        return Inertia::render('EncounterGenerator/CreateContext');
    }

    public function doDelete(Request $request, Context $context): RedirectResponse
    {
        $context->delete();

        return to_route('generator');
    }

    public function edit(int $context): Response
    {
        $contextToEdit = Context::find($context);
        return Inertia::render(
            'EncounterGenerator/EditContext',
            [
                'context' => $contextToEdit,
            ]
        );
    }

    public function doEdit(EditContextRequest $request, Context $context): RedirectResponse
    {
        $context->update($request->validated());

        return to_route('generator');
    }
}
