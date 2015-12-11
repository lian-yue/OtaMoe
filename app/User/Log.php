<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-03 09:25:51
/*
/* ************************************************************************** */
namespace App\User;
use Illuminate\Database\Eloquent\Model;

class Log extends Model {
	protected $table = 'user_logs';

	protected $fillable = ['user_id', 'type', 'ip', 'content'];
}
