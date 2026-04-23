<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Season;
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

    public function create(): Response
    {
        return Inertia::render('admin/seasons/Form', [
            'divisions' => Division::with('league')->orderBy('name')->get(['id', 'name', 'league_id']),
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

        Season::create($data);

        return redirect()->route('admin.seasons.index')->with('success', 'Season created.');
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

        return redirect()->route('admin.seasons.index')->with('success', 'Season updated.');
    }

    public function destroy(Season $season): RedirectResponse
    {
        $season->delete();

        return redirect()->route('admin.seasons.index')->with('success', 'Season deleted.');
    }
}