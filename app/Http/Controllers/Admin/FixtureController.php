<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fixture;
use App\Models\Round;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FixtureController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Fixture::with(['homeTeam', 'awayTeam', 'season.division.league', 'round'])
            ->orderByDesc('scheduled_at');

        if ($request->filled('season_id')) {
            $query->where('season_id', $request->season_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return Inertia::render('admin/fixtures/Index', [
            'fixtures' => $query->paginate(25)->withQueryString(),
            'seasons' => Season::with('division.league')->orderByDesc('start_date')->get(['id', 'name', 'division_id']),
            'filters' => $request->only(['season_id', 'status']),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/fixtures/Form', [
            'seasons' => Season::with('division.league')->orderByDesc('start_date')->get(['id', 'name', 'division_id']),
            'teams' => Team::orderBy('name')->get(['id', 'name']),
            'rounds' => Round::orderBy('name')->get(['id', 'name', 'stage_id']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'season_id' => 'required|exists:seasons,id',
            'round_id' => 'nullable|exists:rounds,id',
            'home_team_id' => 'required|exists:teams,id|different:away_team_id',
            'away_team_id' => 'required|exists:teams,id',
            'scheduled_at' => 'nullable|date',
            'venue' => 'nullable|string|max:255',
            'status' => 'required|in:scheduled,in_progress,completed,postponed,cancelled',
            'home_score' => 'nullable|integer|min:0',
            'away_score' => 'nullable|integer|min:0',
        ]);

        Fixture::create($data);

        return redirect()->route('admin.fixtures.index')->with('success', 'Fixture created.');
    }

    public function edit(Fixture $fixture): Response
    {
        return Inertia::render('admin/fixtures/Form', [
            'fixture' => $fixture->load(['homeTeam', 'awayTeam', 'season', 'round']),
            'seasons' => Season::with('division.league')->orderByDesc('start_date')->get(['id', 'name', 'division_id']),
            'teams' => Team::orderBy('name')->get(['id', 'name']),
            'rounds' => Round::orderBy('name')->get(['id', 'name', 'stage_id']),
        ]);
    }

    public function update(Request $request, Fixture $fixture): RedirectResponse
    {
        $data = $request->validate([
            'season_id' => 'required|exists:seasons,id',
            'round_id' => 'nullable|exists:rounds,id',
            'home_team_id' => 'required|exists:teams,id|different:away_team_id',
            'away_team_id' => 'required|exists:teams,id',
            'scheduled_at' => 'nullable|date',
            'venue' => 'nullable|string|max:255',
            'status' => 'required|in:scheduled,in_progress,completed,postponed,cancelled',
            'home_score' => 'nullable|integer|min:0',
            'away_score' => 'nullable|integer|min:0',
        ]);

        $fixture->update($data);

        return redirect()->route('admin.fixtures.index')->with('success', 'Fixture updated.');
    }

    public function destroy(Fixture $fixture): RedirectResponse
    {
        $fixture->delete();

        return redirect()->route('admin.fixtures.index')->with('success', 'Fixture deleted.');
    }
}