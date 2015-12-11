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
	public function index() {
		return view('feedback')->withTypes(config('feedback.types'));
	}

	public function store(Request $request) {
		$types = config('feedback.types');
		$type = $request->input('type', key($types));
		$type = isset($types[$type]) ? $type : key($types[$type]);
		$content = $request->input('content');
		$url = $request->input('url');
		$ip = $request->ip();
		$contact_type = $request->input('contact_type');
		$contact_value = $request->input('contact_value');
		Feedback::create(compact($type, $content, $url, $ip, $contact_value, $contact_type));
		return redirect()->back()->withMessage(Lang::get('feedback.store'));
	}
}