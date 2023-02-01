<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\RoundController;
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
    return redirect()->route('locations.index');
});

Route::resource('players', PlayerController::class);
Route::resource('games', GameController::class);
Route::resource('rounds', RoundController::class)->except('index');
Route::resource('locations', LocationController::class)->only(['index','show']);


