<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-01 11:07:25
/*
/* ************************************************************************** */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class News extends Model {
	use SoftDeletes;

	public static $rules = [
		'status'=>'integer|in:-127,127',
		'type' => 'required|max:32',
		'title' => 'required|max:255',
		'excerpt' => 'max:65535',
		'content' => 'required|max:65535',
	];

	protected $dates = ['published_at'];
}