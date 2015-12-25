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

use Hash;
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
		'username' => 'required|min:3|unique:users,username,{id}',
		'password' => 'required|between:6,128|confirmed',
		'password_confirmation' => 'required|between:6,128',
	];

	protected $fillable = ['nickname', 'username', 'password', 'permission'];

	protected $hidden = ['password', 'remember_token'];


	public function getPermissionAttribute($value) {
		return explode(',', $value);
	}

	public function setPasswordAttribute($value) {
		$this->attributes['password'] = Hash::make($value);
	}

	public function setPermissionAttribute($value) {
		if (is_array($value)) {
			$value = implode(',', $value);
		}
		$this->attributes['permission'] = implode(',', array_filter(explode(',', $value)));
	}

}