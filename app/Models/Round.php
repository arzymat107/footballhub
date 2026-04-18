<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Round extends Model
{
    protected $fillable = ['stage_id', 'name', 'order', 'home_away'];

    // null = inherit from stage; true/false = override
    protected $casts = [
        'home_away' => 'boolean',
    ];

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class);
    }

    public function ties(): HasMany
    {
        return $this->hasMany(Tie::class);
    }

    public function fixtures(): HasMany
    {
        return $this->hasMany(Fixture::class);
    }

    public function isHomeAway(): bool
    {
        return $this->home_away ?? $this->stage->home_away;
    }
}