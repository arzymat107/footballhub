<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified', 'admin'])
    ->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('leagues', Admin\LeagueController::class);
        Route::resource('divisions', Admin\DivisionController::class);
        Route::resource('teams', Admin\TeamController::class);
        Route::resource('players', Admin\PlayerController::class);
        Route::resource('seasons', Admin\SeasonController::class);
        Route::get('seasons/{season}/squad', [Admin\SquadController::class, 'show'])->name('seasons.squad');
        Route::post('seasons/{season}/squad', [Admin\SquadController::class, 'store'])->name('seasons.squad.store');
        Route::delete('seasons/{season}/squad/{registration}', [Admin\SquadController::class, 'destroy'])->name('seasons.squad.destroy');
        Route::resource('fixtures', Admin\FixtureController::class);
        Route::get('fixtures/{fixture}/detail', [Admin\FixtureDetailController::class, 'show'])->name('fixtures.detail');
        Route::post('fixtures/{fixture}/lineup', [Admin\FixtureDetailController::class, 'storeLineup'])->name('fixtures.lineup.store');
        Route::delete('fixtures/{fixture}/lineup/{lineup}', [Admin\FixtureDetailController::class, 'destroyLineup'])->name('fixtures.lineup.destroy');
        Route::post('fixtures/{fixture}/events', [Admin\FixtureDetailController::class, 'storeEvent'])->name('fixtures.events.store');
        Route::delete('fixtures/{fixture}/events/{event}', [Admin\FixtureDetailController::class, 'destroyEvent'])->name('fixtures.events.destroy');
    });