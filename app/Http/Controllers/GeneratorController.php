<?php

namespace App\Http\Controllers;

use App\Models\Context;
use App\Models\Encounter;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GeneratorController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render('EncounterGenerator/Generator', [
            'encounters' => Encounter::all(),
            'contexts'   => Context::all(),
        ]);
    }
}
