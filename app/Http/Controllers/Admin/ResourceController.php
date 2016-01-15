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
use Auth;
use Route;
use Validator;
use App\User\log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class ResourceController extends Controller{

	protected $model;

	protected $title = ['base' => 'Posts', 'index' => 'All Posts'];

	protected $withName = '';

	protected $withPost = 'post';

	protected $withPosts = 'posts';

	protected $fields = [];

	public function __construct() {
		$this->authorize('permission', $this->withName);
		view()->share('fields', $this->fields);
		view()->share('title', $this->title);
		view()->share('withName', $this->withName);
		view()->share('withPost', $this->withPost);
		view()->share('withPosts', $this->withPosts);
	}


	public function index(Request $request) {
		$model = new $this->model;
		switch ($request->input('filter')) {
			case 'all':
				$model = $model->withTrashed();
				break;
			case 'trashed':
				$model = $model->onlyTrashed();
		}
		$model = $model->orderBy('id', 'DESC')->paginate(20);
		foreach ($request->query() as $key => $value) {
			$model->addQuery($key, $value);
		}
		return view(view()->exists('admin.'. $this->withName .'.index') ? 'admin.'. $this->withName .'.index' : 'admin.resource.index')->with([$this->withPosts => $model]);
	}

	public function create() {
		return view(view()->exists('admin.'. $this->withName .'.create') ? 'admin.'. $this->withName .'.create' : 'admin.resource.create');
	}

	public function store(Request $request) {
		$input = $this->input($request, 'create');
		if ($rules = $this->rules($input, $request)) {
			$validator = Validator::make($input, $rules);
			if ($validator->fails()) {
				$this->throwValidationException($request, $validator);
			}
		}
		foreach ($input as $key => $value) {
			if (strpos($key, '_confirmation')) {
				unset($input[$key]);
			}
		}

		$model = (new $this->model($input));
		$model->save();
		log::create(['user_id' => $request->user()->id, 'type' => $this->withName, 'content' => $input, 'ip' => $request->ip()]);
		if ($request->input('json') || $request->ajax()) {
			return (new $this->model)->findOrFail($model->id);
		}
		return redirect('/admin/'. $this->withName .'/'. $model->id .'/edit');
	}

	public function show($id) {
		$this->permission($id);
		$model = (new $this->model)->findOrFail($id);
		view()->share('withShow', true);
		if (app('request')->input('json') || app('request')->ajax()) {
			return (new $this->model)->findOrFail($model->id);
		}
		return view(view()->exists('admin.'. $this->withName .'.show') ? 'admin.'. $this->withName .'.show' : 'admin.resource.show')->with([$this->withPost => $model]);
	}


	public function edit($id) {
		$this->permission($id);
		$model = (new $this->model)->findOrFail($id);
		if (app('request')->input('json') || app('request')->ajax()) {
			return (new $this->model)->findOrFail($model->id);
		}
		return view(view()->exists('admin.'. $this->withName .'.edit') ? 'admin.'. $this->withName .'.edit' : 'admin.resource.edit')->with([$this->withPost => $model]);
	}


	public function update(Request $request, $id) {
		$this->permission($id);
		$model = (new $this->model)->findOrFail($id);
		$input = $this->input($request, 'update');
		if ($rules = $this->rules($input, $request, $id)) {
			$validator = Validator::make($input, $rules);
			if ($validator->fails()) {
				$this->throwValidationException($request, $validator);
			}
		}
		foreach ($input as $key => $value) {
			if (!strpos($key, '_confirmation')) {
				$model->$key = $value;
			}
		}
		$model->save();
		log::create(['user_id' => $request->user()->id, 'type' => $this->withName, 'content' => ['id' => $id] + $input, 'ip' => $request->ip()]);
		if ($request->input('json') || $request->ajax()) {
			return (new $this->model)->findOrFail($model->id);
		}
		return redirect()->back();
	}

	public function destroy($id) {
		$this->permission($id);
		(new $this->model)->findOrFail($id)->delete();
		log::create(['user_id' => Auth::user()->id, 'type' => $this->withName, 'content' => ['id' => $id, 'method' => 'destroy'], 'ip' => app('request')->ip()]);
		return redirect()->back();
	}


	public function restore($id) {
		$this->permission($id);
		(new $this->model)->withTrashed()->findOrFail($id)->restore();
		log::create(['user_id' => Auth::user()->id, 'type' => $this->withName, 'content' => ['id' => $id, 'method' => 'restore'], 'ip' => app('request')->ip()]);
		return redirect()->back();
	}


	protected function permission($id) {
		return true;
	}
	protected function rules($input, Request $request, $id = NULL) {
		$className = $this->model;
		if (empty($className::$rules)) {
			return [];
		}
		return array_map(function($rule) use($id) { return strtr($rule, ['{id}' => $id === NULL ? 'NULL' : $id]); }, array_intersect_key($className::$rules, $input));
	}

	protected function input(Request $request, $method = 'create') {
		$names = [];
		foreach ($this->fields as $value) {
			if (!empty($value['name']) && !empty($value['methods']) && isset($value['methods'][$method])) {
				$names[$value['name']] = true;
			}
		}
		$input = array_intersect_key($request->input(), $names);
		foreach ($input as &$inputValue) {
			if (is_string($inputValue)) {
				$inputValue = trim($inputValue);
			}
		}
		return $input;
	}
}