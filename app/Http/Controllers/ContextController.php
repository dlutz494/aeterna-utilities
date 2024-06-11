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
    public function index(): Response
    {
        $contextData = Context::all()->map(function ($context) {
            return [
                'id'         => $context->id,
                'title'      => $context->title,
                'edit_url'   => route('context.edit', $context),
                'delete_url' => route('context.delete', $context),
            ];
        });

        return Inertia::render(
            'Admin/ContextIndex',
            [
                'contexts'   => $contextData,
                'create_url' => route('context.create'),
                'pagination' => 15,
            ]
        );
    }

    public function doCreate(CreateContextRequest $request): RedirectResponse
    {
        Context::factory()->create($request->validated());

        return to_route('context.index');
    }

    public function create(): Response
    {
        return Inertia::render('Admin/CreateContext');
    }

    public function doDelete(Request $request, Context $context): RedirectResponse
    {
        $context->delete();

        return to_route('context.index');
    }

    public function edit(Context $context): Response
    {
        return Inertia::render(
            'Admin/EditContext',
            [
                'context' => $context,
            ]
        );
    }

    public function doEdit(EditContextRequest $request, Context $context): RedirectResponse
    {
        $context->update($request->validated());

        return to_route('context.index');
    }
}
