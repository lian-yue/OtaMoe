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
use Auth;
use Storage;
use Validator;
use App\File;
use App\User\log;
use Illuminate\Http\Request;

class FileController extends ResourceController {
	protected $model = File::class;

	protected $title = [
		'name' => 'Files',
		'index' => 'All Files',
		'show' => 'Show File',
		'create' => 'Create File',
		'update' => 'Edit File',
	];

	protected $withName = 'file';

	protected $withPost = 'file';

	protected $withPosts = 'files';

	protected $fields = [
		['name' => 'id', 'title' => 'ID', 'type' => 'number', 'methods' => ['index' => 1, 'show' => 1]],
		['name' => 'name', 'title' => 'Name', 'type' => 'text', 'methods' => ['index' => 2, 'create' => 1, 'update' => 1, 'show' => 3]],
		['name' => 'file', 'title' => 'File', 'type' => 'file', 'methods' => ['create' => 2]],
		['name' => 'mime', 'title' => 'Mime', 'type' => 'text', 'methods' => ['index' => 3, 'show' => 4]],
		['name' => 'size', 'title' => 'Size', 'type' => 'text', 'methods' => ['index' => 4, 'show' => 6], 'callback' => 'App\Http\Controllers\Admin\FileController::formatSize'],
		['name' => 'created_at', 'title' => 'Created', 'type' => 'datetime', 'methods' => ['index' => 6, 'show' => 2]],
		['name' => 'url', 'title' => 'Url', 'type' => 'callback', 'methods' => ['update' => 99, 'show' => 99], 'callback' => 'App\Http\Controllers\Admin\FileController::showUrl'],
	];


	public function store(Request $request) {
		$input = $this->input($request, 'create');
		$input['file'] = $request->file('file');
		if (empty($input['name'])) {
			$input['name'] = $input['file'] ? $input['file']->getClientOriginalName() : 'Unknown';
			$request->request->set('name', $input['name']);
		}

		$className = $this->model;
		if (!empty($className::$rules)) {
			$validator = $this->validate($request, array_map(function($rule) { return strtr($rule, ['{id}' => 'NULL']); }, array_intersect_key($className::$rules, $input)));
		}


		$input['mime'] = $input['file']->getMimeType();
		$input['size'] = $input['file']->getClientSize();
		$input['path'] = gmdate('Ymd/His') . mt_rand() .'.' . $input['file']->guessExtension();
		Storage::put($input['path'], fopen($input['file']->getPathname(), 'r'));
		unset($input['file']);

		$model = (new $this->model($input));
		$model->save();
		log::create(['user_id' => $request->user()->id, 'type' => $this->withName, 'content' => $input, 'ip' => $request->ip()]);

		if ($request->input('json') || $request->ajax()) {
			return (new $this->model)->findOrFail($model->id);
		}
		return redirect('/admin/'. $this->withName .'/'. $model->id .'/edit');
	}


	public static function showUrl($value, $field) {
		if (in_array($value->mime, ['image/jpeg', 'image/png', 'image/gif'])) {
			$res = '<a href="'. $value->url .'" target="_blank"><img src="'. $value->url .'" /></a>';
		} else {
			$res = '<a class="btn btn-block btn-social btn-dropbox" href="'. $value->url .'" target="_blank"><i class="fa fa-download"></i> '.Lang::get('Download').'</a>';
		}
		return '<div>'.$res  .'</div>';
	}

	public static function formatSize($value, $field) {
		$size = $value->$field['name'];
        if ($size > 1024 * 1024) {
            return round($size / 1024 / 1024, 2).' MB';
        } elseif ($size > 1024) {
            return round($size / 1024, 2).' KB';
        }
        return $size . ' B';
    }
}