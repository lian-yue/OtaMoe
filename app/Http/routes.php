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


	Route::resource('/user', 'UserController', ['names' => ['index' => 'user.index', 'create' => 'user.create', 'store' => 'user.store', 'edit' => 'user.edit', 'update' => 'user.update', 'destroy' => 'user.destroy'], 'except' => ['show']]);
	Route::get('/user/{id}/destroy', ['as' => 'user.destroy', 'middleware' => 'csrf', 'uses' => 'UserController@destroy']);
	Route::get('/user/{id}/restore', ['as' => 'user.restore', 'middleware' => 'csrf', 'uses' => 'UserController@restore']);

	Route::resource('/file', 'FileController', ['names' => ['index' => 'file.index', 'create' => 'file.create', 'store' => 'file.store', 'edit' => 'file.edit', 'update' => 'file.update', 'destroy' => 'file.destroy', 'show' => 'file.show'], 'except' => []]);
	Route::get('/file/{id}/destroy', ['as' => 'file.destroy', 'middleware' => 'csrf', 'uses' => 'FileController@destroy']);
	Route::get('/file/{id}/restore', ['as' => 'file.restore', 'middleware' => 'csrf', 'uses' => 'FileController@restore']);

	Route::resource('/news', 'NewsController', ['names' => ['index' => 'news.index', 'create' => 'news.create', 'store' => 'news.store', 'edit' => 'news.edit', 'update' => 'news.update', 'destroy' => 'news.destroy'], 'except' => ['show']]);
	Route::get('/news/{id}/destroy', ['as' => 'news.destroy', 'middleware' => 'csrf', 'uses' => 'NewsController@destroy']);
	Route::get('/news/{id}/restore', ['as' => 'news.restore', 'middleware' => 'csrf', 'uses' => 'NewsController@restore']);

	Route::resource('/project', 'ProjectController', ['names' => ['index' => 'project.index', 'create' => 'project.create', 'store' => 'project.store', 'edit' => 'project.edit', 'update' => 'project.update', 'destroy' => 'project.destroy'], 'except' => ['show']]);
	Route::get('/project/{id}/destroy', ['as' => 'project.destroy', 'middleware' => 'csrf', 'uses' => 'ProjectController@destroy']);
	Route::get('/project/{id}/restore', ['as' => 'project.restore', 'middleware' => 'csrf', 'uses' => 'ProjectController@restore']);

	Route::resource('/page', 'PageController', ['names' => ['index' => 'page.index', 'create' => 'page.create', 'store' => 'page.store', 'edit' => 'page.edit', 'update' => 'page.update', 'destroy' => 'page.destroy'], 'except' => ['show']]);
	Route::get('/page/{id}/destroy', ['as' => 'page.destroy', 'middleware' => 'csrf', 'uses' => 'PageController@destroy']);
	Route::get('/page/{id}/restore', ['as' => 'page.restore', 'middleware' => 'csrf', 'uses' => 'PageController@restore']);


	Route::resource('/feedback', 'FeedbackController', ['names' => ['index' => 'feedback.index', 'show' => 'feedback.show', 'destroy' => 'feedback.destroy'], 'except' => ['create', 'store', 'edit', 'update']]);
	Route::get('/feedback/{id}/read', ['as' => 'feedback.read', 'middleware' => 'csrf', 'uses' => 'FeedbackController@read']);
	Route::get('/feedback/{id}/unread', ['as' => 'feedback.unread', 'middleware' => 'csrf', 'uses' => 'FeedbackController@unread']);
	Route::get('/feedback/{id}/destroy', ['as' => 'feedback.destroy', 'middleware' => 'csrf', 'uses' => 'FeedbackController@destroy']);
	Route::get('/feedback/{id}/restore', ['as' => 'feedback.restore', 'middleware' => 'csrf', 'uses' => 'FeedbackController@restore']);


	Route::get('/logout', ['as' => 'logout', 'middleware' => 'csrf', 'uses' => 'HomeController@getLogout']);
	Route::controller('/', 'HomeController', ['getIndex' => 'index', 'getlogin' => 'login', 'getProfile' => 'profile', 'getLog' => 'log']);
});


Route::resource('/news', 'NewsController', ['only' => ['index', 'show']]);
Route::resource('/project', 'ProjectController', ['only' => ['index', 'show']]);
Route::resource('/feedback', 'FeedbackController', ['only' => ['index', 'show', 'store']]);

Route::get('/', 'PageController@index');
Route::get('/{slug}', 'PageController@show')->where('slug', '[0-9a-zA-Z._/-]+');