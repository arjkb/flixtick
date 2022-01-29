<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * Get the watchlists for the movie.
     *
     * @return void
     */
    public function watchlists()
    {
        return $this->hasMany(Watchlist::class);
    }
}
