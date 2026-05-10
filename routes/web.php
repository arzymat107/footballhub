<?php

use App\Http\Controllers\FixtureController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\SeasonTeamController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', [LeagueController::class, 'index'])->name('home');

Route::inertia('/about', 'public/Home', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('about');
Route::get('/leagues/{league}', [LeagueController::class, 'show'])->name('leagues.show');
Route::get('/seasons/{season}', [SeasonController::class, 'show'])->name('seasons.show');
Route::get('/seasons/{season}/teams/{team}', [SeasonTeamController::class, 'show'])->name('seasons.teams.show');
Route::get('/fixtures/{fixture}', [FixtureController::class, 'show'])->name('fixtures.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/admin.php';