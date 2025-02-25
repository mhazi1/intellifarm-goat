<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\HasMany;


class Farm extends Model
{
    //
    protected $connection = "mongodb";

    protected $fillable = [
        'name',
        'location',
        'manager_id'
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(User::class, 'farm_id');
    }

    public function livestocks(): HasMany
    {
        return $this->hasMany(Livestock::class);
    }
}
