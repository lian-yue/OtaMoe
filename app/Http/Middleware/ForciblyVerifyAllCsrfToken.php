<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-09 09:44:20
/*
/* ************************************************************************** */
namespace App\Http\Middleware;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
class ForciblyVerifyAllCsrfToken extends BaseVerifier {


	protected function isReading($request) {
		return false;
	}

	protected function shouldPassThrough($request) {
		return false;
	}
}
