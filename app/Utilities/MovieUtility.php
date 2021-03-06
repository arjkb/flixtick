<?php

namespace App\Utilities;

use App\Models\Movie;
use Illuminate\Support\Str;

class MovieUtility
{
    /**
     * Add a movie to the movies table.
     *
     * Does not add the movie if the title already exists in the DB.
     *
     * @param string $title
     * @return integer
     */
    public function addMovie(string $title): int
    {
        $normalizedTitle = Str::of($title)->explode(' ')->filter()->implode(' '); // get rid of extra whitespsaces
        $movie = Movie::where('title', 'like', $normalizedTitle)->first();
        if (is_null($movie)) {
            $movie = new Movie;
            $movie->title = $title;
            $movie->save();
        }

        return $movie->id;
    }
}
