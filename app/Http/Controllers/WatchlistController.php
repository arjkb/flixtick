<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use App\Utilities\WatchlistUtility;
use Illuminate\Http\Request;

class WatchlistController extends Controller
{
    private WatchlistUtility $watchlist;

    public function __construct()
    {
        $this->watchlist = new Watchlist;
    }

    /**
     * Add a movie to watchlist of the user
     *
     * @param Request $request
     * @return void
     */
    public function addToWatchlist(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'year' => 'sometimes|size:4',
        ]);

        $this->watchlist->addToWatchlist(
            auth()->user()->id,
            $validated['title'],
            $validated['year']
        );

        return redirect('home')->with('flash', 'Movie added to watchlist');
    }
}
