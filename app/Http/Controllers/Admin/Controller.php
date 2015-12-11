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

use App\User\log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as _Controller;

abstract class Controller extends _Controller{

	protected $model;

	protected $name = '';

	protected $name = '';

	protected $withPost = 'post';

	protected $withPosts = 'posts';

	protected $attributes = [];

	public function __construct() {
		$this->authorize('permission', $this->name);
	}

	public function index(Request $request) {
		$model = (new $this->model)->orderBy('id', 'DESC')->paginate(20);
		switch ($request->input('filter')) {
			case 'all':
				$model = $model->withTrashed();
				break;
			case 'trashed':
				$model = $model->onlyTrashed();
				break;
		}
		return view('admin.'. $this->name . '.index')->with([$this->withPosts => $model]);
	}

	public function create() {
		return view('/admin.'. $this->name .'.create');
	}

	public function store(Request $request) {
		$model = (new $this->model($value = $this->getAttributes($request, 'store')))->save();
		log::create(['user_id' => $request->user()->id, 'type' => $this->name, 'value' => json_encode($value), 'ip' => $request->ip()]);
		return redirect('/admin/'. $this->name .'/'. $$model->id .'/edit');
	}


	public function edit($id) {
		$this->permission($id);
		$model = (new $this->model)->find($id)->firstOrFail();
		return view('admin.'. $this->name .'.edit')->with([$this->withPost => $model]);
	}


	public function update(Request $request, $id) {
		$this->permission($id);
		(new $this->model)->find($id)->update($value = $this->getAttributes($request, 'update'));
		log::create(['user_id' => $request->user()->id, 'type' => $this->name, 'value' => json_encode(['id' => $id] + $value), 'ip' => $request->ip()]);
		return redirect()->back();
	}

	public function destroy($id) {
		$this->permission($id);
		log::create(['user_id' => Request::user()->id, 'type' => $this->name, 'value' => json_encode(['id' => $id, 'method' => 'destroy']), 'ip' => Request::ip()]);
		(new $this->model)->find($id)->delete();
		return redirect()->back();
	}


	public function restore($id) {
		$this->permission($id);
		(new $this->model)->withTrashed()->find($id)->restore();
		log::create(['user_id' => Request::user()->id, 'type' => $this->name, 'value' => json_encode(['id' => $id, 'method' => 'restore']), 'ip' => Request::ip()]);
		return redirect()->back();
	}


	protected function permission($id) {
		return true;
	}

	protected function getAttributes(Request $request) {
		return array_intersect_key($request->input(), array_fill($this->attributes));
	}
}