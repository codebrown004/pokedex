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

Route::get('/login', 'HomeController@login')->name('login');
Route::post('/login', 'HomeController@authenticate');
Route::get('/signup', 'HomeController@signup')->name('signup');
Route::post('/register', 'HomeController@register');

// user route
Route::get('/', 'UsersController@index')->name('home');
Route::get('/user/profile', 'UsersController@profile');
Route::post('/profile/update', 'UsersController@update');
Route::get('/users/list', 'UsersController@list');
Route::get('/users/pokedex', 'UsersController@pokedex');
Route::get('/logout', 'UsersController@destroy');

Route::post('/adToPokedex', 'PokedexController@add_pokemon');
Route::get('/test', 'PokedexController@test');