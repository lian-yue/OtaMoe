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

class NewsController extends ResourceController {
	protected $model = News::class;

	protected $title = [
		'name' => 'News',
		'index' => 'All News',
		'create' => 'Create News',
		'update' => 'Edit News',
	];

	protected $withName = 'news';


	protected $fields = [
		['name' => 'id', 'title' => 'ID', 'type' => 'number', 'methods' => ['index' => 1]],
		['name' => 'draft', 'title' => 'Draft', 'type' => 'radio', 'methods' => ['index' => 3, 'create' => 2, 'update' => 2], 'option' => [1 => 'True', 0 => 'False'], 'value' => 0],
		['name' => 'type', 'title' => 'Type', 'type' => 'select', 'methods' => ['index' => 4, 'create' => 3, 'update' => 3], 'option' => ['company' => 'Company', 'media' => 'Media']],
		['name' => 'published_at', 'title' => 'Published', 'type' => 'datetime', 'methods' => ['index' => 5, 'create' => 4, 'update' => 4]],

		['name' => 'title', 'title' => 'Title', 'type' => 'text', 'methods' => ['index' => 2, 'create' => 1, 'update' => 1], 'maxlength' => 255, 'required' => true],
		['name' => 'excerpt', 'title' => 'Excerpt', 'type' => 'textarea', 'methods' => ['create' => 6, 'update' => 6], 'rows' => 3, 'maxlength' => 65535],
		['name' => 'content', 'title' => 'Content', 'type' => 'textarea', 'methods' => ['create' => 5, 'update' => 5], 'rows' => 10, 'maxlength' => 65535, 'required' => true, 'editor' => true, 'upload' => true],
	];
}