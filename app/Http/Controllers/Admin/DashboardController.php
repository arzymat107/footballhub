<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fixture;
use App\Models\League;
use App\Models\Player;
use App\Models\Team;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('admin/Dashboard', [
            'stats' => [
                'leagues' => League::count(),
                'teams' => Team::count(),
                'players' => Player::count(),
                'fixtures' => Fixture::count(),
            ],
        ]);
    }
}