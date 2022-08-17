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

Route::get('/', 'PostController@main')->name('main');

Route::get('/show/{id}', 'PostController@show');

Route::middleware('auth')->group(function () {

    Route::get('/edit/{id}', 'PostController@edit');
    Route::post('/edit/{id}', 'PostController@editData')->name('editData');

    Route::get('/security/{id}', 'PostController@security');
    Route::post('/security/{id}', 'PostController@editSecurity')->name('editSecurity');

    Route::get('/status/{id}', 'PostController@status');

    Route::get('/media/{id}', 'PostController@media');

    Route::get('/delete/{id}', 'PostController@delete');

    Route::get('/create', 'PostController@create');
    Route::post('/create', 'PostController@addUser')->name('addUser');

    Route::get('/logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        return redirect(\route('main'));
    });
});

Route::middleware('guest')->group(function () {

    Route::get('/register', 'Auth\RegisterController@page');
    Route::post('/register', 'Auth\RegisterController@save')->name('register');

    Route::get('/login', 'Auth\LoginController@page');
    Route::post('/login', 'Auth\LoginController@login')->name('login');

});




