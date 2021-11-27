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

Route::get('/webapp/{user_id?}', 'WebAppController@index')->middleware('auth')->name('webapp');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
