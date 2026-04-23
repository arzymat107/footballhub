<?php

namespace App\Http\Controllers;

use App\Models\League;
use Inertia\Inertia;
use Inertia\Response;

class LeagueController extends Controller
{
    public function index(): Response
    {
        $leagues = League::withCount('divisions')
            ->orderBy('name')
            ->get();

        return Inertia::render('public/Leagues', [
            'leagues' => $leagues,
        ]);
    }

    public function show(League $league): Response
    {
        $league->load(['divisions.seasons' => function ($q) {
            $q->orderByDesc('start_date');
        }]);

        return Inertia::render('public/LeagueShow', [
            'league' => $league,
        ]);
    }
}