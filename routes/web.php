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

Route::group(['namespace'=>'Backend','prefix'=>'api','middleware'=>'auth'],function(){
    Route::get('users',['as'=>'users','uses'=>'UserController@getAll','name'=>'user.all']);
    Route::post('users',['as'=>'users','uses'=>'UserController@create','name'=>'user.create']);
    Route::put('users',['as'=>'users','uses'=>'UserController@update']);
    Route::delete('users/{id}',['as'=>'users','uses'=>'UserController@delete','name'=>'user.delete']);
});