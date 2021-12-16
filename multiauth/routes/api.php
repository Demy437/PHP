<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//===============================USERS=================================
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//========================LOGIN/REGISTER==================
// Route::group(['middleware' => ['cors', 'json.response']], function () {

//     // public routes
//     Route::post('login', [RegisteredUserController::class, 'login']);
//     Route::post('register', [RegisteredUserController::class, 'register']);
    
    
// });

//=============================CRUD=============================
Route::group(['middleware' => ['auth', 'role:admin']], function() { 
    Route::resource('articles', ArticleController::class);

});