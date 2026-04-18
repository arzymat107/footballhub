<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    protected $fillable = ['league_id', 'name', 'level', 'description'];

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(Season::class);
    }
}