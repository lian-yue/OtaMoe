<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-01 05:55:37
/*
/* ************************************************************************** */
namespace App\Http\Controllers;

use App\News;
use App\Http\Controllers\Controller;
class NewsController extends Controller {
	public function index() {
		$posts = News::whereDraft(0)->orderBy('published_at', 'DESC')->paginate(config('site.news_posts_per_page', 20));
		return view('news.index')->withPosts($posts);
	}

	public function show($id) {
		$post = News::whereDraft(0)->find($id)->firstOrFail();
		if ($post->status != 0) {
			return abort(404);
		}
		return view('news.show')->withPost($post);
	}
}