<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/', 'PostController@main');

Route::get('/edit/{id}', 'PostController@edit');

Route::get('/security/{id}', 'PostController@security');

Route::get('/status/{id}', 'PostController@status');

Route::get('/media/{id}', 'PostController@media');

Route::get('/delete/{id}', 'PostController@delete');

Route::get('/create', 'PostController@create');

Route::get('/show/{id}', 'PostController@show');


Route::get('/register', 'AccountController@register');

Route::get('/login', 'AccountController@login');