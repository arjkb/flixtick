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
        $this->watchlist = new WatchlistUtility;
    }

    /**
     * Get the watchlist for the logged in user.
     *
     * @return void
     */
    public function index()
    {
        $moviesInWatchlist = Watchlist::with('movie')->where('user_id', auth()->user()->id)->get()->sortBy('movie.title', SORT_NATURAL | SORT_FLAG_CASE);

        return view('home', compact('moviesInWatchlist'));
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
            $validated['year'] ?? null
        );

        return redirect('home')->with('flash', 'Movie added to watchlist');
    }
}
