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

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

	protected $model = User::class;

	protected $name = 'user';

	protected $withPost = 'user';

	protected $withPosts = 'users';

	protected $attributes = ['nickname', 'username', 'password', 'permission'];

	protected function getAttributes(Request $request) {
		$attributes = parent::getAttributes($request);
		if (isset($attributes['permission'])) {
			$attributes['permission'] = array_sum((array) $attributes['permission']);
		}
		return $attributes;
	}

	protected function permission($id) {
		if (Auth::user()->id == $id) {
 			abort(403);
		}
	}
}
