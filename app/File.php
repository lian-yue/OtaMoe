<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-21 01:55:44
/*
/* ************************************************************************** */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpFoundation\UploadedFile;

class File extends Model{
    use SoftDeletes;
	public static $rules = [
		'name' => 'required|max:255',
		'url' => 'max:255',
		'size' => 'required|integer',
		'file' => 'required|max:20480|mimes:jpeg,jpg,jpe,gif,png,pdf,doc,docx,xls,xlsx,txt,csv,zip,rar,7z,mp4,psd',
	];

	protected $fillable = ['name', 'path', 'mime', 'size'];

	public function setPathAttribute($value) {
		$this->attributes['path'] = trim($value, '/');
		$this->attributes['url'] = rtrim(config('site.file_url_base'), '/') . '/' . $this->attributes['path'];
	}
}