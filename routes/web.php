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
Route::view('/contact', 'contact')->name('contact');

Route::get('/admin/login', fn() => redirect()->route('auth.login'))->name('filament.auth.login');

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

Route::prefix('/promotions')->name('promotions.')->group(static function () {
    Route::view('/loyalty-program', 'promotions.loyalty-program')->name('loyalty-program');
    Route::view('/freeroll-tournaments', 'promotions.freeroll-tournaments')->name('freeroll-tournaments');
    Route::view('/giveaways', 'promotions.giveaways')->name('giveaways');
    Route::view('/first-deposit-bonus', 'promotions.first-deposit-bonus')->name('first-deposit-bonus');
    Route::view('/referral-program', 'promotions.referral-program')->name('referral-program');
});

Route::prefix('/tracker')->name('tracker.')->group(static function () {
    Route::get('/', IndexController::class)->name('index');
    Route::get('/player/{id}', PlayerController::class)->name('player');
    Route::get('/session/{id}', SessionController::class)->name('session');
});
