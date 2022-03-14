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




Route::get('quiz', 'QuizyController@index');

Route::get('quiz/{id?}', 'QuizyController@get');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/login', 'QuizyController@getAuth');
Route::post('admin/login', 'QuizyController@postAuth');

Route::get('admin/title', 'QuizyController@titleIndex')->middleware('auth');

Route::get('admin/title/create', 'QuizyController@titleAdd')->middleware('auth');
Route::post('admin/title/create', 'QuizyController@titleCreate');

Route::get('admin/title/edit', 'QuizyController@titleEdit')->middleware('auth');
Route::post('admin/title/edit', 'QuizyController@titleUpdate');

Route::get('admin/title/del', 'QuizyController@titleDel')->middleware('auth');
Route::post('admin/title/del', 'QuizyController@titleRemove');

Route::get('admin/question/edit', 'QuizyController@questionEdit')->middleware('auth');
Route::post('admin/question/edit', 'QuizyController@questionUpdate');

Route::get('admin/question/create', 'QuizyController@questionAdd')->middleware('auth');
Route::post('admin/question/create', 'QuizyController@questionCreate');

Route::post('admin/question/create', 'QuizyController@questionCreate');

Route::get('admin/choice/edit', 'QuizyController@choiceEdit')->middleware('auth');
Route::post('admin/choice/edit', 'QuizyController@choiceUpdate');

Route::get('admin/choice/create', 'QuizyController@choiceAdd')->middleware('auth');
Route::post('admin/choice/create', 'QuizyController@choiceCreate');

Route::post('admin/choice/del', 'QuizyController@choiceRemove');