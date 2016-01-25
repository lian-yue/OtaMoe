<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-02 12:22:57
/*
/* ************************************************************************** */
namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Controller;
class FeedbackController extends Controller {
	public function index(Request $request) {
		$messages = [];
		if ($request->session()->get('message', false)) {
			$messages = [
				Lang::get('feedback.message'),
			];
			$request->session()->forget('message');
		}
		return view('feedback')->withMessages($messages);
	}

	public function store(Request $request) {
		$rules = [
			'content' => 'required|max:65535',
			'contact_type' => 'required|max:32',
			'contact_value' => 'required|max:255',
		];
		$this->validate($request, $rules);

		$input = array_map('trim', array_intersect_key($request->input(), $rules));
		$input['ip'] = $request->ip();
		Feedback::create($input);
		return redirect()->back()->withMessage(true);
	}
}