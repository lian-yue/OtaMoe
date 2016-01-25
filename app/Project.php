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
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Project extends Model{
	use SoftDeletes;
	public static $rules = [
		'sort' => 'integer',
		'self' => 'integer|in:0,1',
		'slug' => 'required|max:32|unique:projects,slug,{id}',
		'logo' => 'max:255',
		'url' => 'max:255',
		'excerpt' => 'max:65535',
		'content' => 'required|max:65535',
	];

	protected $dates = ['published_at'];

	protected $fillable = ['sort', 'self', 'slug', 'logo', 'name', 'url', 'title', 'excerpt', 'content', 'published_at'];

	public function setExcerptAttribute($value) {
		$this->attributes['excerpt'] = trim($value ? $value: Str::limit(strip_tags($this->attributes['content']), 255, ''));
	}
	public function setPublishedAtAttribute($value) {
		$this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d H:i:s', (new DateTime($value))->format('Y-m-d H:i:s'));
	}
}