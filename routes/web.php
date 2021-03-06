<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\WatchlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('about', fn () => view('about'));

Route::prefix('auth')->group(function () {
    Route::prefix('signup')->group(function () {
        Route::get('', fn () => view('auth.signup'));
        Route::post('', [LoginController::class, 'signup']);
    });

    Route::prefix('login')->group(function () {
        Route::get('', fn () => view('auth.login'))->name('login');
        Route::post('', [LoginController::class, 'authenticate']);
    });

    Route::post('logout', [LoginController::class, 'logout']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [WatchlistController::class, 'index']);

    Route::controller(WatchlistController::class)->group(function () {
        Route::prefix('watchlist')->name('watchlist.')->group(function () {
            Route::post('', 'addToWatchList');
            Route::prefix('{id}')->group(function () {
                Route::get('', 'show')->name('show');
                Route::post('mark-watched', 'markAsWatched')->name('mark-watched');
                Route::post('mark-unwatched', 'markAsUnwatched')->name('mark-unwatched');
                Route::delete('', 'destroy')->name('destroy');
            });
        });
    });
});