<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-02 14:14:22
/*
/* ************************************************************************** */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User\Log;


class HomeController extends Controller {
	use ThrottlesLogins, AuthenticatesUsers {
		AuthenticatesUsers::getLogin as parentGetLogin;
	}

	protected $redirectTo = '/admin';

	protected $loginPath = '/admin/login';

	protected $username = 'username';



	protected function authenticated(Request $request, Authenticatable $user) {
		log::create(['user_id' => $user->id, 'type' => 'login', 'ip' => $request->ip()]);
		return redirect()->intended($this->redirectPath());
	}

	public function getIndex() {
		return view('admin.index');
	}

	public function getLogin() {
        return view('admin.login');
	}
	public function getLog() {
        return view('admin.log');
	}

	public function getProfile(Request $request) {
		return view('admin.profile')->withUser($request->user());
	}

	public function postProfile(Request $request) {
		$input = array_intersect_key($request->input(), ['nickname' => '', 'password' => '']);
		if (!isset($input['password'])) {

		} elseif ($input['password'] === '') {
			unset($input['password']);
		} elseif (!Hash::check($request->input('password_old'), $request->user()->password)) {
			return redirect()->back()->withErrors(['password_old' => Lang::get('admin.password_old')]);
		} else {
			$input['password'] = Hash::make($input['password']);
		}
		User::whereId($request->user()->id)->update($input);
		return redirect()->back();
	}
}