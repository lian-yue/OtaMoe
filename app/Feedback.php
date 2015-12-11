<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-02 11:33:34
/*
/* ************************************************************************** */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model {
	use SoftDeletes;

	public static $rules = [
		'status'=>'integer|in:-127,127',
		'type' => 'required|max:32',
		'content'=>'required|max:65535',
		'url' => 'max:255',
		'ip' => 'required|ip',
		'contact_type' => 'max:32',
		'contact_value' => 'max:255',
	];

	protected $fillable = ['status', 'type', 'content', 'url', 'ip', 'contact_type', 'contact_value'];
}