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
class Project extends Model{
	use SoftDeletes;
	public static $rules = [
		'sort' => 'integer',
		'self' => 'integer|in:0,1',
		'slug' => 'required|max:32|unique:projects,slug,{id}',
		'type' => 'required',
		'logo' => 'max:255',
		'url' => 'max:255',
		'excerpt' => 'max:65535',
		'content' => 'required|max:65535',
	];
	protected $fillable = ['sort', 'self', 'slug', 'type', 'logo', 'name', 'url', 'title', 'excerpt', 'content'];

	public function setExcerptAttribute($value) {
		$this->attributes['excerpt'] = trim($value ? $value: strip_tags($this->attributes['content']));
	}
}