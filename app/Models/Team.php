<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = ['name', 'short_name', 'logo', 'city', 'country', 'founded_year'];

    public function seasons(): BelongsToMany
    {
        return $this->belongsToMany(Season::class, 'season_teams')->withTimestamps();
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'player_team_seasons')
            ->withPivot('season_id', 'shirt_number')
            ->withTimestamps();
    }

    public function homeFixtures(): HasMany
    {
        return $this->hasMany(Fixture::class, 'home_team_id');
    }

    public function awayFixtures(): HasMany
    {
        return $this->hasMany(Fixture::class, 'away_team_id');
    }
}