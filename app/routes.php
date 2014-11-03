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
	'before' => 'auth',
	'uses' => 'ArticlesController@edit'
]);

Route::post('/articles/{slug}/edit', [
	'as' => 'edit_article_path',
	'before' => 'auth',
	'uses' => 'ArticlesController@update'
]);

Route::post('/articles/{slug}/comments/add', [
	'as' => 'add_comment_path',
	'before' => 'auth',
	'uses' => 'CommentsController@add'
]);

Route::post('/articles/{id}/delete', [
	'as' => 'delete_article_path',
	'before' => 'auth',
	'uses' => 'ArticlesController@destroy'
]);

Route::post('/articles/{id}/publish', [
	'as' => 'publish_article_path',
	'before' => 'auth',
	'uses' => 'ArticlesController@publish'
]);

Route::post('/articles/{id}/unpublish', [
	'as' => 'unpublish_article_path',
	'before' => 'auth',
	'uses' => 'ArticlesController@unpublish'
]);


Route::get('/drafts', [
	'as' => 'drafts_path',
	'before' => 'auth',
	'uses' => 'ArticlesController@drafts'
]);

/** Categories */
Route::get('/categories', [
	'as' => 'categories_path',
	'before' => 'auth',
	'uses' => 'CategoriesController@index'
]);

Route::post('/categories/update/{id}', [
	'as' => 'update_category_path',
	'before' => 'auth',
	'uses' => 'CategoriesController@update'
]);

Route::post('/categories/add', [
	'as' => 'add_category_path',
	'before' => 'auth',
	'uses' => 'CategoriesController@add'
]);

Route::get('/categories/delete/{id}', [
	'as' => 'delete_category_path',
	'before' => 'auth',
	'uses' => 'CategoriesController@destroy'
]);

Route::get('/category/{label}', [
	'as' => 'filter_by_category_path',
	'uses' => 'CategoriesController@filter'
]);

/** Tags */
Route::get('/tags', [
	'as' => 'tags_path',
	'before' => 'auth',
	'uses' => 'TagsController@index'
]);

Route::post('/tags/update/{id}', [
	'as' => 'update_tag_path',
	'before' => 'auth',
	'uses' => 'TagsController@update'
]);

Route::post('/tags/add', [
	'as' => 'add_tag_path',
	'before' => 'auth',
	'uses' => 'TagsController@add'
]);

Route::get('/tags/delete/{id}', [
	'as' => 'delete_tag_path',
	'before' => 'auth',
	'uses' => 'TagsController@destroy'
]);

Route::get('/tags/{label}', [
	'as' => 'filter_by_tag_path',
	'uses' => 'TagsController@filter'
]);
Route::get('/tags/attach/{tag_id}/{article_id}', [
	'as' => 'attach_tag_path',
	'before' => 'auth',
	'uses' => 'TagsController@attach'
]);

Route::get('/tags/detach/{tag_id}/{article_id}', [
	'as' => 'detach_tag_path',
	'before' => 'auth',
	'uses' => 'TagsController@detach'
]);

/** Comments */
Route::get('/comments/{id}/upvote', [
	'as' => 'upvote_comment_path',
	'before' => 'auth',
	'uses' => 'CommentsController@upvote'
]);
Route::get('/comments/{id}/downvote', [
	'as' => 'downvote_comment_path',
	'before' => 'auth',
	'uses' => 'CommentsController@downvote'
]);
Route::get('/comments/{id}/report', [
	'as' => 'report_comment_path',
	'before' => 'auth',
	'uses' => 'CommentsController@report'
]);
Route::get('/comments/{id}/disable', [
	'as' => 'disable_comment_path',
	'before' => 'auth',
	'uses' => 'CommentsController@disable'
]);
Route::get('/comments/{id}/enable', [
	'as' => 'enable_comment_path',
	'before' => 'auth',
	'uses' => 'CommentsController@enable'
]);