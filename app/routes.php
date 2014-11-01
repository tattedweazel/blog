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


/** User Admin */
Route::get('/admin', [
	'as' => 'user_admin_path',
	'before' => 'auth',
	'uses' => 'AdminController@index'
]);

/** Accounts */
Route::get('/account/{id}', [
	'as' => 'account_path',
	'before' => 'auth',
	'uses' => 'AccountController@show'
]);

Route::post('/account/{id}', [
	'as' => 'account_path',
	'before' => 'auth',
	'uses' => 'AccountController@update'
]);

Route::post('/account/{id}/update-password', [
	'as' => 'update_password_path',
	'before' => 'auth',
	'uses' => 'AccountController@updatePassword'
]);

Route::post('/account/{id}/delete',[
	'as' => 'delete_user_path',
	'before' => 'auth',
	'uses' => 'AccountController@destroy'
]);

Route::post('/account/{id}/update-type',[
	'as' => 'update_user_type_path',
	'before' => 'auth',
	'uses' => 'AccountController@updateType'
]);

/** Articles */
Route::get('/articles/new', [
	'as' => 'new_article_path',
	'before' => 'auth',
	'uses' => 'ArticlesController@create'
]);

Route::post('/articles/new', [
	'as' => 'new_article_path',
	'before' => 'auth',
	'uses' => 'ArticlesController@store'
]);

Route::get('/articles/{slug}', [
	'as' => 'article_path',
	'uses' => 'ArticlesController@show'
]);

Route::get('/articles/{slug}/edit', [
	'as' => 'edit_article_path',
	'uses' => 'ArticlesController@edit'
]);

Route::post('/articles/{slug}/edit', [
	'as' => 'edit_article_path',
	'uses' => 'ArticlesController@update'
]);