<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-04 09:55:03
/*
/* ************************************************************************** */
namespace App\Http\Controllers\Admin;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller {
	protected $model = News::class;

	protected $name = 'news';

	protected $attributes = ['status', 'type', 'title', 'excerpt', 'content', 'published_at'];
}