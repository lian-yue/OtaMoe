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

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends ResourceController {
	protected $model = Project::class;

	protected $title = [
		'name' => 'Projects',
		'index' => 'All Projects',
		'create' => 'Create Project',
		'update' => 'Edit Project',
	];

	protected $withName = 'project';

	protected $fields = [
		['name' => 'id', 'title' => 'ID', 'type' => 'number', 'methods' => ['index' => 1]],
		['name' => 'self', 'title' => 'Self', 'type' => 'radio', 'methods' => ['index' => 6, 'create' => 7, 'update' => 7], 'value' => 1, 'option' => [0 => 'False', 1=> 'True']],
		['name' => 'type', 'title' => 'Type', 'type' => 'select', 'methods' => ['index' => 4, 'create' => 6, 'update' => 6], 'option' => ['service' => 'Service', 'game' => 'Game']],
		['name' => 'sort', 'title' => 'Sort', 'type' => 'number', 'methods' => ['index' => 7, 'create' => 5, 'update' => 5], 'value' => 0],
		['name' => 'slug', 'title' => 'Slug', 'type' => 'text', 'methods' => ['index' => 5, 'create' => 4, 'update' => 4], 'maxlength' => 32, 'required' => true],
		['name' => 'name', 'title' => 'Name', 'type' => 'text', 'methods' => ['index' => 3, 'create' => 2, 'update' => 2], 'maxlength' => 32, 'required' => true],
		['name' => 'url', 'title' => 'URL', 'type' => 'text', 'methods' => ['create' => 3, 'update' => 3], 'maxlength' => 255],
		['name' => 'logo', 'title' => 'Logo', 'type' => 'text', 'methods' => ['create' => 3, 'update' => 3], 'maxlength' => 255, 'upload' => 1],
		['name' => 'title', 'title' => 'Title', 'type' => 'text', 'methods' => ['index' => 2, 'create' => 1, 'update' => 1], 'maxlength' => 255, 'required' => true],
		['name' => 'excerpt', 'title' => 'Excerpt', 'type' => 'textarea', 'methods' => ['create' => 9, 'update' => 9], 'rows' => 3, 'maxlength' => 65535],
		['name' => 'content', 'title' => 'Content', 'type' => 'textarea', 'methods' => ['create' => 8, 'update' => 8], 'rows' => 10, 'maxlength' => 65535, 'required' => true, 'editor' => true, 'upload' => 1],
	];
}
