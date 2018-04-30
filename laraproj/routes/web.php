<?php
use App\Task;

Route::get('/', function () {
    return view('/auth/login');
});

Route::get('/test', 'TestController@index');
Route::get('/test/{id}', 'TestController@show');

Auth::routes();

//Facebook login auth routes
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

//GET
Route::get('/settings', 'SettingsController@index');
Route::get('/settings/avatar', 'SettingsController@avatar');
Route::get('/settings/statistics', 'SettingsController@statistics');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/create', 'HomeController@create');
Route::get('/home/edit/{id}', 'HomeController@edit');
Route::get('/home/{order}', 'HomeController@order');
Route::get('/advancedsearch', 'HomeController@advancedSearch');

//POST
Route::post('/settings/avatar/post', 'SettingsController@avatarpost');
Route::post('/home/post', 'HomeController@post');
Route::post('/home/edit', 'HomeController@editpost');
Route::post('/home/delete', 'HomeController@deletepost');
Route::post('/home/search', 'HomeController@search');
Route::post('/advancedsearchpost', 'HomeController@advancedSearchExecute');
