<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stage extends Model
{
    protected $fillable = [
        'season_id', 'name', 'type', 'order',
        'home_away', 'wins_required', 'playoff_qualify_count',
    ];

    protected $casts = [
        'home_away' => 'boolean',
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(StageGroup::class);
    }

    public function rounds(): HasMany
    {
        return $this->hasMany(Round::class)->orderBy('order');
    }

    public function fixtures(): HasMany
    {
        return $this->hasMany(Fixture::class);
    }
}