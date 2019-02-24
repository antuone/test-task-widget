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

Auth::routes();

Route::get('/', 'MessengerController@index');

Route::get('/user/{user}', 'UserController@show');

Route::post('/user/{user}', 'UserController@postmessage');

Route::get('/user/{id_one}/{id_two}', 'UserController@correspondence');

Route::post('/user/delete/{user}', 'UserController@userdelete');

Route::post('/user/recovery/{user}', 'UserController@userrecovery');
