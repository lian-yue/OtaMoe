<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-03 09:25:51
/*
/* ************************************************************************** */
namespace App\User;
use Illuminate\Database\Eloquent\Model;

class Log extends Model {
	protected $table = 'user_logs';

	protected $fillable = ['user_id', 'type', 'ip', 'content'];

	protected $casts = [
		'content' => 'array',
	];

	public function setContentAttribute($value) {
		if ($value && (is_array($value)||is_object($value))) {
			$json = [];
			foreach ($value as $key => $val) {
				$json[$key] = stripos($key, 'password') !== false || stripos($key, 'pwd') !== false || stripos($key, 'passwd') !== false  ? '******' : $val;
			}
			$this->attributes['content'] = json_encode($json);
		} else {
			$this->attributes['content'] = '';
		}
	}
}
