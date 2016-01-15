<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-02 04:09:12
/*
/* ************************************************************************** */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Page extends Model {
	use SoftDeletes;

	public static $rules = [
		'parent' => 'integer|exists:pages,id',
		'slug' => 'required|max:64|unique:pages,slug,{id}',
		'name' => 'required|max:64',
		'icon' => 'max:32',
		'home' => 'integer',
		'menu' => 'integer',
		'excerpt' => 'max:65535',
		'content' => 'required|max:65535',
	];
	protected $fillable = ['parent', 'slug', 'name', 'icon', 'home', 'menu', 'excerpt', 'content'];

	public function setExcerptAttribute($value) {
		$this->attributes['excerpt'] = trim($value ? $value: strip_tags($this->attributes['content']));
	}

	public static function all($columns = ['id', 'name', 'slug', 'url', 'icon', 'parent', 'home', 'menu', 'excerpt']) {
		return call_user_func_array(['parent', 'all'], func_get_args());
	}

	public static function menu() {
		$all[0] = [];
		foreach (self::all()->sortBy('menu', SORT_NUMERIC) as $value) {
			if ($value->menu > 0) {
				$all[$value->parent][] = $value;
			}
		}
		return $all;
	}

	public static function home() {
		$res = [];
		foreach (self::all()->sortBy('home', SORT_NUMERIC) as $value) {
			if ($value->home > 0) {
				$res[] = $value;
			}
		}
		return $res;
	}

}