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

use Lang;
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
		['name' => 'updated_at', 'title' => 'Updated', 'type' => 'datetime', 'methods' => ['index' => 8]],

		['name' => 'home', 'title' => 'Home show', 'type' => 'number', 'methods' => ['create' => 7, 'update' => 7], 'value' => 0],

		['name' => 'menu', 'title' => 'Menu show', 'type' => 'number', 'methods' => ['create' => 7, 'update' => 7], 'value' => 0],

		['name' => 'icon', 'title' => 'Icon', 'type' => 'text', 'methods' => ['create' => 3, 'update' => 3], 'maxlength' => 32],
		['name' => 'slug', 'title' => 'Slug', 'type' => 'text', 'methods' => ['index' => 4, 'create' => 3, 'update' => 3], 'maxlength' => 32, 'required' => true],
		['name' => 'name', 'title' => 'Name', 'type' => 'text', 'methods' => ['index' => 3, 'create' => 2, 'update' => 2], 'maxlength' => 32, 'required' => true],
		['name' => 'url', 'title' => 'Url', 'type' => 'text', 'methods' => ['create' => 5, 'update' => 5], 'maxlength' => 255],
		['name' => 'parent', 'title' => 'Parent', 'type' => 'select', 'methods' => ['index' => 4, 'create' => 4, 'update' => 4], 'callback' => 'App\Http\Controllers\Admin\PageController::parentOption', 'value' => 0],
		['name' => 'excerpt', 'title' => 'Excerpt', 'type' => 'textarea', 'methods' => ['create' => 9, 'update' => 9], 'rows' => 3, 'maxlength' => 65535],
		['name' => 'content', 'title' => 'Content', 'type' => 'textarea', 'methods' => ['create' => 8, 'update' => 8], 'rows' => 10, 'maxlength' => 65535, 'required' => true, 'editor' => true],
	];

	public static function parentOption($post, &$form, $type) {
		$all = [0 => []];
		foreach (Page::all() as $value) {
			$all[$value->parent][] = $value;
		}
		$options = [0 => Lang::get('Node')];
		$callback = function($id, $level) use($all, $post, &$options, &$callback) {
			foreach ($all[$id] as $value) {
				if (empty($options[$value->id]) && (!$post || $post->id != $value->id)) {
					$options[$value->id] = str_repeat('-', $level) . $value->name;
					if (!empty($all[$value->id])) {
						$callback($value->id, $level + 1);
					}
				}
			}
		};
		$callback(0, 0);

		$form['option'] = $options;
		return $post ? $post->parent : $form['value'];
	}

	protected function rules($input, Request $request, $id = NULL) {
		$rules = parent::rules($input, $request, $id);
		if (isset($input['parent']) && $input['parent'] == 0) {
			unset($rules['parent']);
		}
		return $rules;
	}
}
