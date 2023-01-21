<?php

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

Route::middleware('guest')->name('auth.')->group(static function() {
    Route::view('/login', 'auth.login')->name('login');

    Route::view('/register', 'auth.register')->name('register');
});
