<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-01 11:06:55
/*
/* ************************************************************************** */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Item extends Model{
	use SoftDeletes;
	public static $rules = [
		'sort' => 'integer',
		'self' => 'integer|in:-127,127',
		'slug' => 'required|max:32|unique:items',
		'type' => 'required',
		'url' => 'max:255',
		'title' => 'required|max:255',
		'excerpt' => 'max:65535',
		'content' => 'required|max:65535',
	];
}