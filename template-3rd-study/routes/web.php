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
Route::post('/study_time_post', 'WebAppController@store')->middleware('auth')->name('webapp_post');
Route::get('/user_update', 'WebAppController@user_edit')->middleware('auth')->name('user_edit');
Route::post('/user_update', 'WebAppController@user_update')->middleware('auth')->name('user_update');
Route::post('/user_destroy/{id}', 'WebAppController@user_destroy')->middleware('auth')->name('user_destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
