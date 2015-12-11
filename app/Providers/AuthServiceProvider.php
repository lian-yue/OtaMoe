<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-01 02:42:41
/*
/* ************************************************************************** */
namespace App\Providers;

use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate) {
		$gate->define('permission', function(User $user, $name) {
			static $permissions = [
				'file' => 4,
				'user' => 8,
				'page' => 16,
				'item' => 32,
				'news' => 64,
				'feedback' => 128,
			];
			if (empty($permissions[$name])) {
				return false;
			}
			return $user->permission % 2 || $user->permission % $permissions[$name];
		});
		parent::registerPolicies($gate);
    }
}
