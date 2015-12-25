<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-10 03:27:26
/*
/* ************************************************************************** */
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="none">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@lang('Log in')</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<!--csrf meta-->
	<meta name="csrf-token" content="{{Session::getToken()}}" />

	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="{{URL::asset('/assets/bootstrap/css/bootstrap.min.css')}}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{URL::asset('/assets/font-awesome/css/font-awesome.min.css')}}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{URL::asset('/assets/Ionicons/css/ionicons.min.css')}}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{URL::asset('/assets/admin/css/AdminLTE.min.css')}}">
	<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
				page. However, you can choose any other skin. Make sure you
				apply the skin class to the body tag so the changes take effect.
	-->
	<link rel="stylesheet" href="{{URL::asset('/assets/admin/css/skins/skin-blue.min.css')}}">

	<!-- iCheck -->
	<link rel="stylesheet" href="{{URL::asset('/assets/iCheck/skins/square/blue.css')}}">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script type="text/javascript" src="{{URL::asset('/assets/html5shiv/html5shiv.min.css')}}"></script>
	<script type="text/javascript" src="{{URL::asset('/assets/html5shiv/respond.min.css')}}"></script>
	<![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		<b>Admin</b>Log in
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		@if (!empty($errors) && $errors->count())
			@foreach($errors->all() as $error)
				<p class="login-box-msg">{{$error}}</p>
			@endforeach
		@endif
		<form action="{{URL::current()}}" method="post">
			<div class="form-group has-feedback">
				<input name="username" type="text" class="form-control" placeholder="Username" value="{{Request::old('username')}}">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input name="password" type="password" class="form-control" placeholder="Password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-8">
					<div class="checkbox icheck" name="checkbox">
						<label>
							<input name="remember" type="checkbox"> @lang('Remember Me')
						</label>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" class="btn btn-primary btn-block btn-flat">@lang('Sign In')</button>
				</div>
				<!-- /.col -->
			</div>
			{!!csrf_field()!!}
		</form>

		<!-- /.social-auth-links -->

	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- jQuery 2.1.4 -->
<script type="text/javascript" src="{{URL::asset('/assets/jQuery/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script type="text/javascript" src="{{URL::asset('/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="{{URL::asset('/assets/admin/js/app.min.js')}}"></script>

<!-- iCheck -->
<script type="text/javascript" src="{{URL::asset('/assets/iCheck/js/icheck.min.js')}}"></script>

<script type="text/javascript">
	$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		});
	});
</script>
</body>
</html>