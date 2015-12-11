<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-01 05:55:18
/*
/* ************************************************************************** */
namespace App\Http\Controllers;

use App\Item;
use App\Http\Controllers\Controller;
class ItemController extends Controller {
	public function index() {
		$posts = Item::orderBy('sort', 'ASC')->paginate(config('item.posts_per_page'));
		return view('item.index')->withPosts($posts);
	}

	public function show($slug) {
		$post = Item::whereSlug($slug)->firstOrFail();
		return view('item.post')->withPost($post);
	}
}