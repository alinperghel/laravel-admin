<?php

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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('users/verify/{user}', 'UserController@verify')->name('users.verify');
Route::get('users/unverify/{user}', 'UserController@unverify')->name('users.unverify');
Route::resource('users', 'UserController');
