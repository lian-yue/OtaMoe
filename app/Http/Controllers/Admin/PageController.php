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

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller {
	protected $model = Page::class;

	protected $name = 'page';

	protected $attributes = ['sort', 'slug', 'name', 'title', 'excerpt', 'content'];
}