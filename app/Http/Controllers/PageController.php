<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-01 05:55:12
/*
/* ************************************************************************** */
namespace App\Http\Controllers;

use App\Page;
use App\Http\Controllers\Controller;
class PageController extends Controller {
	public function index() {
		return view('index');
	}

	public function show($slug) {
		$post = Page::whereSlug($slug)->firstOrFail();
		return view(view()->exists($post->slug) ? $post->slug : 'show')->withPost($post);
	}
}