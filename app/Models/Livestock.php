<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Livestock extends Model
{
    //
    protected $connection = "mongodb";

    protected $fillable = [
        'species',
        'age',
        'date_of_birth',
        'gender',
        'status'
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
}
