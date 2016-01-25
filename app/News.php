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
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Str;
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

	protected $fillable = ['draft', 'type', 'title', 'excerpt', 'content', 'published_at'];

	public function setPublishedAtAttribute($value) {
		$this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d H:i:s', (new DateTime($value))->format('Y-m-d H:i:s'));
	}
	public function setExcerptAttribute($value) {
		$this->attributes['excerpt'] = trim($value ? $value: Str::limit(strip_tags($this->attributes['content']), 255, ''));
	}
}