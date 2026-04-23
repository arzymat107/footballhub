<?php

use App\Http\Controllers\LeagueController;
use App\Http\Controllers\SeasonController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'public/Home', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::get('/leagues', [LeagueController::class, 'index'])->name('leagues.index');
Route::get('/leagues/{league}', [LeagueController::class, 'show'])->name('leagues.show');
Route::get('/seasons/{season}', [SeasonController::class, 'show'])->name('seasons.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/admin.php';