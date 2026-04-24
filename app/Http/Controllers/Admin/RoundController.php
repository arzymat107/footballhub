<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Round;
use App\Models\Stage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RoundController extends Controller
{
    public function show(Round $round): Response
    {
        $round->load(['stage.season.division.league', 'fixtures' => fn ($q) => $q->with(['homeTeam', 'awayTeam'])->orderBy('scheduled_at')]);

        return Inertia::render('admin/rounds/Show', [
            'round' => $round,
        ]);
    }

    public function create(Request $request): Response
    {
        $stage = Stage::with('season.division.league')->findOrFail($request->integer('stage_id'));

        return Inertia::render('admin/rounds/Form', [
            'stage' => $stage,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'stage_id' => 'required|exists:stages,id',
            'name' => 'required|string|max:255',
            'order' => 'required|integer|min:1',
            'home_away' => 'nullable|boolean',
        ]);

        Round::create($data);

        return redirect()->route('admin.stages.show', $data['stage_id'])->with('success', 'Round created.');
    }

    public function edit(Round $round): Response
    {
        $round->load('stage.season.division.league');

        return Inertia::render('admin/rounds/Form', [
            'round' => $round,
            'stage' => $round->stage,
        ]);
    }

    public function update(Request $request, Round $round): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer|min:1',
            'home_away' => 'nullable|boolean',
        ]);

        $round->update($data);

        return redirect()->route('admin.stages.show', $round->stage_id)->with('success', 'Round updated.');
    }

    public function destroy(Round $round): RedirectResponse
    {
        $stageId = $round->stage_id;
        $round->delete();

        return redirect()->route('admin.stages.show', $stageId)->with('success', 'Round deleted.');
    }
}