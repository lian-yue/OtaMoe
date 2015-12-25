<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-02 09:34:46
/*
/* ************************************************************************** */
use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder {

	public function run() {
		DB::table('users')->truncate();
		User::create(['nickname' => 'admin', 'username' => 'admin', 'permission' => ['user', 'file', 'page', 'project', 'news', 'feedback'], 'password' => '123456']);
	}
}
