<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-11 06:01:35
/*
/* ************************************************************************** */
namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model{
    use SoftDeletes;
	public static $rules = [
		'user_id' => 'required|integer',
		'name' => 'required|max:255',
		'path' => 'required|max:255',
		'mime' => 'required|max:64',
		'size' => 'required|integer'
	];

	protected $fillable = ['user_id', 'name', 'path', 'mime', 'size'];
}