<?php

use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::prefix('signup')->group(function () {
        Route::get('', fn () => view('auth.signup'));
        Route::post('', [LoginController::class, 'signup']);
    });

    Route::prefix('login')->group(function () {
        Route::get('', fn () => view('auth.login'));
    });
});
