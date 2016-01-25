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
		'content'=>'required|max:65535',
		'ip' => 'required|ip',
		'contact_type' => 'max:32',
		'contact_value' => 'max:255',
	];

	protected $fillable = ['status', 'content', 'ip', 'contact_type', 'contact_value'];

	public static function unreadCount() {
		return (new static)->where('status', '=', 0)->count();
	}
}