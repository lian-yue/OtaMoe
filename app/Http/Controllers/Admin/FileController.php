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

use App\User;
use Illuminate\Http\Request;

class FileController extends Controller {

	protected $model = File::class;

	protected $name = 'file';

	protected $withPost = 'file';

	protected $withPosts = 'files';

	protected $attributes = [];
}
