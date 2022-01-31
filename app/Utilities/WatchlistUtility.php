<?php

namespace App\Utilities;

use App\Models\Movie;
use App\Models\Watchlist;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

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
     * @return integer|null
     */
    public function addToWatchlist(int $userId, string $title): int|null
    {
        $movieId = $this->movie->addMovie($title);

        if (Watchlist::where('user_id', $userId)->where('movie_id', $movieId)->exists()) {
            // the title is already in the user's watchlist; abort
            return null;
        }

        $watchlist = new Watchlist;
        $watchlist->user_id = $userId;
        $watchlist->movie_id = $movieId;
        $watchlist->save();

        return $watchlist->id;
    }

    /**
     * Mark a given watchlist item as watched.
     *
     * @param Watchlist $watchlistItem
     * @return void
     */
    public function markAsWatched(Watchlist $watchlistItem)
    {
        $watchlistItem->marked_seen_at = now();
        $watchlistItem->save();
    }

    /**
     * Mark a given watchlist item as unwatched.
     *
     * @param Watchlist $watchlistItem
     * @return void
     */
    public function markAsUnwatched(Watchlist $watchlistItem)
    {
        $watchlistItem->marked_seen_at = null;
        $watchlistItem->save();
    }
}
