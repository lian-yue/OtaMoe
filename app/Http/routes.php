<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-11-30 08:42:49
/*
/* ************************************************************************** */
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin::', 'middleware' => 'auth'], function() {
	Route::get('/user/{id}/restore', ['as' => 'user.restore', 'middleware' => 'csrf', 'uses' => 'UserController@restore']);
	Route::resource('/user', 'UserController', ['names' => ['index' => 'user.index', 'create' => 'user.create', 'store' => 'user.store', 'show' => 'user.show', 'edit' => 'user.edit', 'update' => 'user.update', 'destroy' => 'user.destroy']]);

	Route::get('/feedback/{id}/restore', ['as' => 'feedback.restore', 'middleware' => 'csrf', 'uses' => 'FeedbackController@restore']);
	Route::resource('/feedback', 'FeedbackController', ['names' => ['index' => 'feedback.index', 'create' => 'feedback.create', 'store' => 'feedback.store', 'show' => 'feedback.show', 'edit' => 'feedback.edit', 'update' => 'feedback.update', 'destroy' => 'feedback.destroy']]);

	Route::get('/news/{id}/restore', ['as' => 'news.restore', 'middleware' => 'csrf', 'uses' => 'NewsController@restore']);
	Route::resource('/news', 'NewsController', ['names' => ['index' => 'news.index', 'create' => 'news.create', 'store' => 'news.store', 'show' => 'news.show', 'edit' => 'news.edit', 'update' => 'news.update', 'destroy' => 'news.destroy']]);

	Route::get('/item/{id}/restore', ['as' => 'item.restore', 'middleware' => 'csrf', 'uses' => 'ItemController@restore']);
	Route::resource('/item', 'ItemController', ['names' => ['index' => 'item.index', 'create' => 'item.create', 'store' => 'item.store', 'show' => 'item.show', 'edit' => 'item.edit', 'update' => 'item.update', 'destroy' => 'item.destroy']]);

	Route::get('/page/{id}/restore', ['as' => 'page.restore', 'middleware' => 'csrf', 'uses' => 'PageController@restore']);
	Route::resource('/page', 'PageController', ['names' => ['index' => 'page.index', 'create' => 'page.create', 'store' => 'page.store', 'show' => 'page.show', 'edit' => 'page.edit', 'update' => 'page.update', 'destroy' => 'page.destroy']]);

	Route::get('/file/{id}/restore', ['as' => 'file.restore', 'middleware' => 'csrf', 'uses' => 'FileController@restore']);
	Route::resource('/file', 'PageController', ['names' => ['index' => 'file.index', 'create' => 'file.create', 'store' => 'file.store', 'show' => 'file.show', 'edit' => 'file.edit', 'update' => 'file.update', 'destroy' => 'file.destroy']]);


	Route::get('/logout', ['as' => 'logout', 'middleware' => 'csrf', 'uses' => 'HomeController@getLogout']);
	Route::controller('/', 'HomeController', ['getIndex' => 'index', 'getlogin' => 'login', 'getProfile' => 'profile', 'getLog' => 'log']);
});


Route::resource('/news', 'NewsController', ['only' => ['index', 'show']]);
Route::resource('/item', 'ItemController', ['only' => ['index', 'show']]);
Route::resource('/feedback', 'FeedbackController', ['only' => ['index', 'show', 'store']]);

Route::get('/', 'PageController@index');
Route::get('/{slug}', 'PageController@show')->where('slug', '[0-9a-zA-Z._/-]');