<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-02 08:23:22
/*
/* ************************************************************************** */
namespace App;


use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


class User extends Model implements AuthenticatableContract, AuthorizableContract{
	use Authenticatable, Authorizable, SoftDeletes;
	public static $rules = [
		'nickname'=>'required|max:32',
		'username' => 'required|min:3|unique:users',
		'password' => 'required|between:6,128|confirmed',
		'password_confirmation' => 'required|between:6,128',
		'permission' => 'integer',
	];

	protected $fillable = ['nickname', 'username', 'password'];

	protected $hidden = ['password', 'remember_token'];
}