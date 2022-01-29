<?php

namespace App\Utilities;

use App\Models\Movie;
use App\Models\Watchlist;

class WatchlistUtility
{
    private MovieUtility $movie;

    public function __construct()
    {
        $this->movie = new MovieUtility;
    }

    /**
     * Add movie to the given user's watchlist.
     * 
     * Add the movie to the movies table if it's not already there.
     *
     * @param integer $userId
     * @param string $title
     * @param string|null $year
     * @return void
     */
    public function addToWatchlist(int $userId, string $title, ?string $year)
    {
        $movieId = $this->movie->addMovie($title, $year);

        $watchlist = new Watchlist;
        $watchlist->user_id = $userId;
        $watchlist->movie_id = $movieId;
        $watchlist->save();
    }
}
