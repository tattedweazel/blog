<?php

Route::get('/', [
	'as' => 'home',
	'uses' => 'PagesController@home'
]);


/** Log In / Out */
Route::get('/login', [
	'as' => 'login_path',
	'before' => 'guest',
	'uses' => 'SessionsController@index'
]);

Route::post('/login', [
	'as' => 'login_path',
	'before' => 'guest',
	'uses' => 'SessionsController@store'
]);

Route::get('/logout',[
	'as' => 'logout_path',
	'before' => 'auth',
	'uses' => 'SessionsController@destroy'
]);

/** Registration */

Route::get('/register', [
	'as' => 'register_path',
	'before' => 'guest',
	'uses' => 'RegistrationsController@index'
]);

Route::post('/register', [
	'as' => 'register_path',
	'before' => 'guest',
	'uses' => 'RegistrationsController@store'
]);