<?php
use App\Http\Controllers\ClubController;
use App\Http\Controllers\PlayerController;
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

Route::resource('clubs', ClubController::class);

Route::resource('players', PlayerController::class);

Route::get('player/create/{vlub_id}', 'App\Http\Controllers\Playercontroller@create');

