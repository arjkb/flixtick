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
        $unwatchedMovies = Watchlist::with('movie')
        ->where('user_id', auth()->user()->id)
            ->whereNull('marked_seen_at')
            ->get()
            ->sortBy('movie.title', SORT_NATURAL | SORT_FLAG_CASE);

        $watchedMovies = Watchlist::with('movie')
        ->where('user_id', auth()->user()->id)
            ->whereNotNull('marked_seen_at')
            ->get()
            ->sortBy('movie.title', SORT_NATURAL | SORT_FLAG_CASE);

        return view('home', compact('unwatchedMovies', 'watchedMovies'));
    }

    /**
     * Show a watchlist item.
     *
     * @param integer $watchlistId
     * @return void
     */
    public function show(int $watchlistId)
    {
        // TODO: authorization

        $watchlistItem = Watchlist::find($watchlistId);

        return view('watchlist.show', compact('watchlistItem'));
    }

    /**
     * Remove a record from the watchlist of a user.
     *
     * @param integer $watchlistId
     * @return void
     */
    public function destroy(int $watchlistId)
    {
        $w = Watchlist::find($watchlistId);
        $w->delete();

        return redirect('home')->with('flash-danger', $w->movie->title . ' removed from your watchlist');
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

        $watchlistItemId = $this->watchlist->addToWatchlist(
            auth()->user()->id,
            $validated['title'],
            $validated['year'] ?? null
        );

        $flashMessage = isset($watchlistItemId) ? 'Movie added to watchlist' : 'Title already in your watchlist. Not added.';

        return redirect('home')->with('flash', $flashMessage);
    }

    /**
     * Mark a movie as watched
     *
     * @param integer $id
     * @return void
     */
    public function markAsWatched(Request $request, int $id)
    {
        // TODO: authorization

        $this->watchlist->markWatchlistItemAsWatched($id);

        return back()->with('flash-success', Watchlist::find($id)->movie->title . ' marked as watched');
    }

    /**
     * Mark a movie as unwatched.
     *
     * @param integer $id
     * @return void
     */
    public function markAsUnwatched(int $id)
    {
        // TODO: authorization

        $this->watchlist->markWatchlistItemAsUnwatched($id);

        return back()->with('flash-warning', Watchlist::find($id)->movie->title . ' marked as unwatched');
    }
}
