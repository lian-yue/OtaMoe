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

use App\Page;
use Illuminate\Http\Request;

class PageController extends ResourceController {
	protected $model = Page::class;


	protected $title = [
		'name' => 'Pages',
		'index' => 'All Pages',
		'create' => 'Create Page',
		'update' => 'Edit Page',
	];

	protected $withName = 'page';

	protected $fields = [
		['name' => 'id', 'title' => 'ID', 'type' => 'number', 'methods' => ['index' => 1]],
		['name' => 'sort', 'title' => 'Sort', 'type' => 'number', 'methods' => ['index' => 5, 'create' => 4, 'update' => 4], 'value' => 0],
		['name' => 'updated_at', 'title' => 'Updated', 'type' => 'datetime', 'methods' => ['index' => 8]],
		['name' => 'slug', 'title' => 'Slug', 'type' => 'text', 'methods' => ['index' => 4, 'create' => 3, 'update' => 3], 'maxlength' => 32, 'required' => true],
		['name' => 'name', 'title' => 'Name', 'type' => 'text', 'methods' => ['index' => 3, 'create' => 2, 'update' => 2], 'maxlength' => 32, 'required' => true],
		['name' => 'title', 'title' => 'Title', 'type' => 'text', 'methods' => ['index' => 2, 'create' => 1, 'update' => 1], 'maxlength' => 255, 'required' => true],
		['name' => 'excerpt', 'title' => 'Excerpt', 'type' => 'textarea', 'methods' => ['create' => 6, 'update' => 6], 'rows' => 3, 'maxlength' => 65535],
		['name' => 'content', 'title' => 'Content', 'type' => 'textarea', 'methods' => ['create' => 5, 'update' => 5], 'rows' => 10, 'maxlength' => 65535, 'required' => true, 'editor' => true],
	];
}