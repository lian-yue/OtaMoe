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

use App\Project;
use App\Http\Controllers\Controller;
class ProjectController extends Controller {
	public function index() {
		$posts = Project::orderBy('sort', 'ASC')->paginate(config('site.project_posts_per_page', 20));
		return view('project.index')->withPosts($posts);
	}

	public function show($slug) {
		$post = Project::whereSlug($slug)->firstOrFail();
		return view('project.show')->withPost($post);
	}
}