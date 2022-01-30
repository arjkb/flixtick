<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;

    protected $casts = [
        'user_id' => 'integer',
    ];

    /**
     * Get the movie that owns this watchlist record.
     *
     * @return void
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
