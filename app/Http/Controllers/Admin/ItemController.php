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

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller {
	protected $model = Item::class;

	protected $name = 'item';

	protected $attributes = ['slug', 'sort', 'self', 'type', 'name', 'url', 'title' , 'excerpt' , 'content'];
}
