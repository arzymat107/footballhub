<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SeasonController extends Controller
{
    public function index(): Response
    {
        $seasons = Season::with('division.league')
            ->orderByDesc('start_date')
            ->paginate(20);

        return Inertia::render('admin/seasons/Index', [
            'seasons' => $seasons,
        ]);
    }

    public function show(Season $season): Response
    {
        $season->load(['division.league', 'stages' => fn ($q) => $q->orderBy('order'), 'teams' => fn ($q) => $q->orderBy('name')]);

        return Inertia::render('admin/seasons/Show', [
            'season' => $season,
            'allTeams' => Team::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function attachTeam(Request $request, Season $season): RedirectResponse
    {
        $data = $request->validate(['team_id' => 'required|exists:teams,id']);
        $season->teams()->syncWithoutDetaching([$data['team_id']]);

        return back();
    }

    public function detachTeam(Season $season, Team $team): RedirectResponse
    {
        $season->teams()->detach($team->id);

        return back();
    }

    public function create(Request $request): Response
    {
        return Inertia::render('admin/seasons/Form', [
            'divisions' => Division::with('league')->orderBy('name')->get(['id', 'name', 'league_id']),
            'divisionId' => $request->integer('division_id') ?: null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'name' => 'required|string|max:255',
            'format' => 'required|in:round_robin,knockout,group_knockout,playoff',
            'status' => 'required|in:upcoming,active,completed',
            'track_players' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $season = Season::create($data);

        return redirect()->route('admin.divisions.show', $season->division_id)->with('success', 'Season created.');
    }

    public function edit(Season $season): Response
    {
        return Inertia::render('admin/seasons/Form', [
            'season' => $season,
            'divisions' => Division::with('league')->orderBy('name')->get(['id', 'name', 'league_id']),
        ]);
    }

    public function update(Request $request, Season $season): RedirectResponse
    {
        $data = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'name' => 'required|string|max:255',
            'format' => 'required|in:round_robin,knockout,group_knockout,playoff',
            'status' => 'required|in:upcoming,active,completed',
            'track_players' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $season->update($data);

        return redirect()->route('admin.divisions.show', $season->division_id)->with('success', 'Season updated.');
    }

    public function destroy(Season $season): RedirectResponse
    {
        $divisionId = $season->division_id;
        $season->delete();

        return redirect()->route('admin.divisions.show', $divisionId)->with('success', 'Season deleted.');
    }
}