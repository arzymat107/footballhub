<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class League extends Model
{
    protected $fillable = ['name', 'country', 'logo', 'description'];

    public function divisions(): HasMany
    {
        return $this->hasMany(Division::class);
    }
}