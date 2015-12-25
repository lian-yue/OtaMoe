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
		'sort' => 'integer',
		'slug' => 'required|max:32|unique:pages,slug,{id}',
		'name' => 'required|max:255',
		'title' => 'required|max:255',
		'excerpt' => 'max:65535',
		'content' => 'required|max:65535',
	];
	protected $fillable = ['sort', 'slug', 'name', 'title', 'excerpt', 'content'];

	public function setExcerptAttribute($value) {
		$this->attributes['excerpt'] = trim($value ? $value: strip_tags($this->attributes['content']));
	}
}