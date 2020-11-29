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

Route::get('/', function () {
    return view('welcome');
});

// == Auth

Route::get('/registration', 'AuthController@getRegistration')->name('auth.getRegistration');
Route::post('/registration', 'AuthController@postRegistration')->name('auth.postRegistration');
Route::get('/login', 'AuthController@getLogin')->name('auth.getLogin');
Route::post('/login', 'AuthController@postLogin')->name('auth.postLogin');
Route::get('/logout', 'AuthController@logout')->name('auth.logout');


// == UserProfile

Route::middleware('auth')->group(function() {
    Route::get('/profile/{id}', 'UserProfileController@show')->name('profile.show');
    Route::post('/profile/{id}/follow', 'UserProfileController@follow')->name('profile.follow');
    Route::post('/profile/{id}/unfollow', 'UserProfileController@unfollow')->name('profile.unfollow');
});


// == Recipes

Route::get('/recipes', 'RecipeController@index')->name('recipes.index');

Route::middleware('auth')->group(function() {
    Route::get('/recipes/create', 'RecipeController@create')->name('recipes.create');
    Route::post('/recipes', 'RecipeController@store')->name('recipes.store');
    Route::get('/recipes/{id}', 'RecipeController@show')->name('recipes.show'); // ->middleware('auth');
    Route::get('/recipes/{id}/edit', 'RecipeController@edit')->name('recipes.edit');
    Route::put('/recipes/{id}', 'RecipeController@update')->name('recipes.update');
    Route::delete('/recipes/{id}', 'RecipeController@destroy')->name('recipes.destroy');
});
