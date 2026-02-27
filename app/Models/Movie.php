<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'tmdb_id',
        'title',
        'poster_url',
        'overview',
        'release_date',
        'genre',
        'rating',
        'synced_at',
    ];
}
