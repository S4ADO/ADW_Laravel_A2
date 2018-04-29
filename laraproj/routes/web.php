<?php

use App\Task;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', 'TestController@index');
Route::get('/test/{id}', 'TestController@show');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/create', 'HomeController@create');
Route::get('/home/edit/{id}', 'HomeController@edit');
Route::post('/home/post', 'HomeController@post');
Route::post('/home/edit', 'HomeController@editpost');
Route::post('/home/delete', 'HomeController@deletepost');
Route::post('/home/search', 'HomeController@search');
