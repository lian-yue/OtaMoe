<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-04 09:55:03
/*
/* ************************************************************************** */
namespace App\Http\Controllers\Admin;
use Auth;
use App\User;
use Illuminate\Http\Request;

class UserController extends ResourceController{

	protected $model = User::class;

	protected $title = [
		'name' => 'Users',
		'index' => 'All Users',
		'create' => 'Create User',
		'update' => 'Edit User',
	];


	protected $withName = 'user';

	protected $withPost = 'user';

	protected $withPosts = 'users';

	protected $fields = [
		['name' => 'id', 'title' => 'ID', 'type' => 'number', 'methods' => ['index' => 1]],
		['name' => 'created_at', 'title' => 'Created', 'type' => 'datetime', 'methods' => ['index' => 8]],
		['name' => 'updated_at', 'title' => 'Updated', 'type' => 'datetime', 'methods' => ['index' => 8]],
		['name' => 'username', 'title' => 'Username', 'type' => 'text', 'methods' => ['index' => 2, 'create' => 1, 'update' => 1], 'required' => true],
		['name' => 'nickname', 'title' => 'Nickname', 'type' => 'text', 'methods' => ['index' => 3, 'create' => 2, 'update' => 2], 'required' => true],
		['name' => 'password', 'title' => 'Password', 'type' => 'password', 'methods' => ['create' => 2, 'update' => 2], 'required' => true],
		['name' => 'password_confirmation', 'title' => 'Confirm password', 'type' => 'password', 'methods' => ['create' => 3, 'update' => 3], 'required' => true],
		['name' => 'permission', 'title' => 'Permissions', 'type' => 'checkbox', 'methods' => ['create' => 4, 'update' => 4], 'option' => ['user' => 'User', 'file' => 'File', 'page' => 'Page', 'project' => 'Project', 'news' => 'News', 'feedback' => 'Feedback']],
	];

	protected function input(Request $request, $method = 'create') {
		$input = parent::input($request, $method);
		if (empty($input['password']) && $method == 'update') {
			unset($input['password'], $input['password_confirmation']);
		}
		return $input;
	}
}
