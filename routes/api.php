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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// API routes for movies
Route::get('/store-movies', 'MovieController@storeMovies');
Route::get('/all', 'MovieController@index');
Route::get('/get-a-movie/{id}', 'MovieController@getAMovie');
Route::post('/store-favorite/{id}', 'MovieController@storeFavorite');
Route::delete('/remove-favorite/{movie}', 'MovieController@removeFavorite');
Route::get('/all-favorite-movies/{id}', 'MovieController@listFavoriteMovies');

// API routes for user 
Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');
