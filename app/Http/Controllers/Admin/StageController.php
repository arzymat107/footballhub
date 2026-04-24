<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\Stage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StageController extends Controller
{
    public function show(Stage $stage): Response
    {
        $stage->load(['season.division.league', 'rounds' => fn ($q) => $q->withCount('fixtures')->orderBy('order')]);

        return Inertia::render('admin/stages/Show', [
            'stage' => $stage,
        ]);
    }

    public function create(Request $request): Response
    {
        $season = Season::with('division.league')->findOrFail($request->integer('season_id'));

        return Inertia::render('admin/stages/Form', [
            'season' => $season,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'season_id' => 'required|exists:seasons,id',
            'name' => 'required|string|max:255',
            'type' => 'required|in:league,group,knockout',
            'order' => 'required|integer|min:1',
            'home_away' => 'boolean',
            'wins_required' => 'nullable|integer|min:1',
            'playoff_qualify_count' => 'nullable|integer|min:1',
        ]);

        Stage::create($data);

        return redirect()->route('admin.seasons.show', $data['season_id'])->with('success', 'Stage created.');
    }

    public function edit(Stage $stage): Response
    {
        $stage->load('season.division.league');

        return Inertia::render('admin/stages/Form', [
            'stage' => $stage,
            'season' => $stage->season,
        ]);
    }

    public function update(Request $request, Stage $stage): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:league,group,knockout',
            'order' => 'required|integer|min:1',
            'home_away' => 'boolean',
            'wins_required' => 'nullable|integer|min:1',
            'playoff_qualify_count' => 'nullable|integer|min:1',
        ]);

        $stage->update($data);

        return redirect()->route('admin.seasons.show', $stage->season_id)->with('success', 'Stage updated.');
    }

    public function destroy(Stage $stage): RedirectResponse
    {
        $seasonId = $stage->season_id;
        $stage->delete();

        return redirect()->route('admin.seasons.show', $seasonId)->with('success', 'Stage deleted.');
    }
}