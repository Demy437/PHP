<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ClubController;
use App\Http\Controllers\Api\PlayerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get   ('clubs',          'App\Http\Controllers\Api\ClubController@getAllClubs');
Route::get   ('clubs/{id}',     'App\Http\Controllers\Api\ClubController@getClub');
Route::post  ('clubs',          'App\Http\Controllers\Api\ClubController@createClub');
Route::put   ('clubs/{id}',     'App\Http\Controllers\Api\ClubController@updateClub');
Route::delete('clubs/{id}',     'App\Http\Controllers\Api\ClubController@deleteClub');

Route::get   ('players',          'App\Http\Controllers\Api\PlayerController@getAllPlayers');
Route::get   ('players/{id}',     'App\Http\Controllers\Api\PlayerController@getPlayer');
Route::post  ('players',          'App\Http\Controllers\Api\PlayerController@createPlayer');
Route::put   ('players/{id}',     'App\Http\Controllers\Api\PlayerController@updatePlayer');
Route::delete('players/{id}',     'App\Http\Controllers\Api\PlayerController@deletePlayer');

