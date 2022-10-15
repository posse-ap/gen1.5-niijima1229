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

Route::get('/webapp', 'WebAppController@index')->middleware('auth')->name('webapp');
Route::post('/study_time_post', 'WebAppController@store')->middleware('auth')->name('webapp_post');
Route::get('/user_update', 'WebAppController@user_edit')->middleware('auth')->name('user_edit');
Route::post('/user_update', 'WebAppController@user_update')->middleware('auth')->name('user_update');
Route::post('/user_destroy/{id}', 'WebAppController@user_destroy')->middleware('auth')->name('user_destroy');


Route::get('/admin', 'AdminController@index')->middleware('auth')->middleware('admin')->name('admin');

Route::get('/admin/language', 'AdminController@language')->middleware('auth')->middleware('admin')->name('language');
Route::post('/admin/language_create', 'AdminController@language_create')->middleware('auth')->middleware('admin')->name('language_create');
Route::post('/admin/language_update/{id}', 'AdminController@language_update')->middleware('auth')->middleware('admin')->name('language_update');
Route::post('/admin/language_destroy/{id}', 'AdminController@language_destroy')->middleware('auth')->middleware('admin')->name('language_destroy');

Route::get('/admin/content', 'AdminController@content')->middleware('auth')->middleware('admin')->name('content');
Route::post('/admin/content_create', 'AdminController@content_create')->middleware('auth')->middleware('admin')->name('content_create');
Route::post('/admin/content_update/{id}', 'AdminController@content_update')->middleware('auth')->name('content_update');
Route::post('/admin/content_destroy/{id}', 'AdminController@content_destroy')->middleware('auth')->name('content_destroy');

Route::get('/admin/user', 'AdminController@user')->middleware('auth')->middleware('admin')->name('user');
Route::post('/admin/user_create', 'AdminController@user_create')->middleware('auth')->middleware('admin')->name('user_create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
