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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace'=>'Backend'],function(){
    Route::get('api/users',['as'=>'users','uses'=>'UserController@getAll']);
    Route::post('api/users',['as'=>'users','uses'=>'UserController@create']);
    Route::put('api/users',['as'=>'users','uses'=>'UserController@update']);
});