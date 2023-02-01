<?php

use App\Http\Controllers\Tracker\IndexController;
use App\Http\Controllers\Tracker\PlayerController;
use App\Http\Controllers\Tracker\SessionController;
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

Route::view('/', 'index')->name('home');

Route::middleware('guest')->name('auth.')->group(static function () {
    Route::view('/login', 'auth.login')->name('login');

    Route::view('/register', 'auth.register')->name('register');
});

Route::prefix('/games')->name('games.')->group(static function () {
    Route::view('/no-limit-holdem', 'games.no-limit-holdem')->name('no-limit-holdem');
    Route::view('/pot-limit-omaha', 'games.pot-limit-omaha')->name('pot-limit-omaha');
    Route::view('/hand-rankings', 'games.hand-rankings')->name('hand-rankings');
    Route::view('/tournaments', 'games.tournaments')->name('tournaments');
    Route::view('/payout-structure', 'games.payout-structure')->name('payout-structure');
});

Route::prefix('/tracker')->name('tracker.')->group(static function () {
    Route::get('/', IndexController::class)->name('index');
    Route::get('/player/{id}', PlayerController::class)->name('player');
    Route::get('/session/{id}', SessionController::class)->name('session');
});
