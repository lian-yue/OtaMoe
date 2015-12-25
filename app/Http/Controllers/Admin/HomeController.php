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
use Hash;
use Lang;
use App\User;
use App\User\Log;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


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
	public function getLog(Request $request) {
		$log = new Log;
		$log = $log->where('user_id', '=', $request->user()->id)->orderBy('id', 'DESC')->paginate(20);
		return view('admin.log')->with(['logs' => $log]);
	}

	public function getProfile(Request $request) {
		return view('admin.profile')->withUser($request->user());
	}

	public function postProfile(Request $request) {
		$input = array_intersect_key($request->input(), ['nickname' => '', 'password' => '', 'password_confirmation' => '']);
		if (!isset($input['password'])) {

		} elseif ($input['password'] === '') {
			unset($input['password'], $input['password_confirmation']);
		} elseif (!Hash::check($request->input('password_old'), $request->user()->password)) {
			return redirect()->back()->withErrors(['password_old' => Lang::get('Old password is not correct')]);
		}
		if (isset(User::$rules)) {
			$validator = Validator::make($input, array_map(function($rule) use($request) { return strtr($rule, ['{id}' => $request->user()->id]); }, array_intersect_key(User::$rules, $input)));
			if ($validator->fails()) {
				$this->throwValidationException($request, $validator);
			}
		}
		unset($input['password_confirmation']);
		$user = (new User)->findOrFail($request->user()->id);
		foreach ($input as $key => $value) {
			$user->$key = $value;
		}
		$user->save();
		log::create(['user_id' => $request->user()->id, 'type' => 'profile', 'ip' => $request->ip(), 'content' => $input]);
		return redirect()->back();
	}
}