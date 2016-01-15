<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-03 05:58:49
/*
/* ************************************************************************** */
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="none">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title') | Control Panel</title>
	<meta name="description" content="@yield('description')" />

	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<!--csrf meta-->
	<meta name="csrf-token" content="{{Session::getToken()}}" />

	@section('style')
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

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script type="text/javascript" src="{{URL::asset('/assets/html5shiv/html5shiv.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('/assets/respond/respond.min.js')}}"></script>
	<![endif]-->
	@show
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<!-- Main Header -->
	<header class="main-header">

		<!-- Logo -->
		<a href="{{URL::current()}}" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>M</b>OE</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>Ota</b>Moe</span>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">@lang('Toggle navigation')</span>
			</a>
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<!-- User Account Menu -->
					<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs">{{Auth::user()->nickname}}</span>
						</a>
						<ul class="dropdown-menu">
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="{{URL::route('admin::profile')}}" class="btn btn-default btn-flat">@lang('Profile')</a>
								</div>
								<div class="pull-right">
									<a href="{{URL::route('admin::logout', ['_token' => csrf_token()])}}" class="btn btn-default btn-flat">@lang('Sign out')</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">


			<!-- Sidebar Menu -->
			<ul class="sidebar-menu">
				<li class="header">@lang('Main navigation')</li>
				<li class="{{(Route::is('admin::index') ? 'active' : '')}}"><a href="{{URL::route('admin::index')}}"><i class="fa fa-home"></i> <span>@lang('Home')</span></a></li>
				@can('permission', 'page')
					<li class="{{(Route::is('admin::page.*') ? 'active ' : '')}}treeview">
						<a href="{{URL::route('admin::page.index')}}"><i class="fa fa-files-o"></i> <span>@lang('Pages')</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li class="{{(Route::is('admin::page.index') ? 'active ' : '')}}"><a href="{{URL::route('admin::page.index')}}"><i class="fa fa-circle-o"></i>@lang('All Pages')</a></li>
							<li class="{{(Route::is('admin::page.create', 'admin::page.edit') ? 'active ' : '')}}"><a href="{{URL::route('admin::page.create')}}"><i class="fa fa-circle-o"></i>@lang('Add Page')</a></li>
						</ul>
					</li>
				@endcan
				@can('permission', 'project')
					<li class="{{(Route::is('admin::project.*') ? 'active ' : '')}}treeview">
						<a href="{{URL::route('admin::project.index')}}"><i class="fa fa-clone"></i> <span>@lang('Projects')</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li class="{{(Route::is('admin::project.index') ? 'active ' : '')}}"><a href="{{URL::route('admin::project.index')}}"><i class="fa fa-circle-o"></i>@lang('All Projects')</a></li>
							<li class="{{(Route::is('admin::project.create', 'admin::project.edit') ? 'active ' : '')}}"><a href="{{URL::route('admin::project.create')}}"><i class="fa fa-circle-o"></i>@lang('Add Project')</a></li>
						</ul>
					</li>
				@endcan
				@can('permission', 'news')
					<li class="{{(Route::is('admin::news.*') ? 'active ' : '')}}treeview">
						<a href="{{URL::route('admin::news.index')}}"><i class="fa fa-newspaper-o"></i> <span>@lang('News')</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li class="{{(Route::is('admin::news.index') ? 'active ' : '')}}"><a href="{{URL::route('admin::news.index')}}"><i class="fa fa-circle-o"></i>@lang('All News')</a></li>
							<li class="{{(Route::is('admin::news.create', 'admin::news.edit') ? 'active ' : '')}}"><a href="{{URL::route('admin::news.create')}}"><i class="fa fa-circle-o"></i>@lang('Add News')</a></li>
						</ul>
					</li>
				@endcan
				@can('permission', 'file')
					<li class="{{(Route::is('admin::file.*') ? 'active ' : '')}}treeview">
						<a href="{{URL::route('admin::file.index')}}"><i class="fa fa-file"></i> <span>@lang('Files')</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li class="{{(Route::is('admin::file.index') ? 'active ' : '')}}"><a href="{{URL::route('admin::file.index')}}"><i class="fa fa-circle-o"></i>@lang('All Files')</a></li>
							<li class="{{(Route::is('admin::file.create', 'admin::file.edit') ? 'active ' : '')}}"><a href="{{URL::route('admin::file.create')}}"><i class="fa fa-circle-o"></i>@lang('Add File')</a></li>
						</ul>
					</li>
				@endcan
				@can('permission', 'feedback')
					<li class="{{(Route::is('admin::feedback.index') ? 'active ' : '')}}"><a href="{{URL::route('admin::feedback.index')}}"><i class="fa fa-comment"></i> <span>@lang('Feedbacks')</span><span class="label label-primary pull-right">{{\App\Feedback::unreadCount()}}</span></a></li>
				@endcan
				@can('permission', 'user')
					<li class="{{(Route::is('admin::user.*') ? 'active ' : '')}}treeview">
						<a href="{{URL::route('admin::user.index')}}"><i class="fa fa-user"></i> <span>@lang('Users')</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li class="{{(Route::is('admin::user.index') ? 'active ' : '')}}"><a href="{{URL::route('admin::user.index')}}"><i class="fa fa-circle-o"></i>@lang('All Users')</a></li>
							<li class="{{(Route::is('admin::user.create', 'admin::user.edit') ? 'active ' : '')}}"><a href="{{URL::route('admin::user.create')}}"><i class="fa fa-circle-o"></i>@lang('Add New')</a></li>
						</ul>
					</li>
				@endcan
				<li class="{{(Route::is('admin::profile', 'admin::log') ? 'active ' : '')}}treeview">
					<a href="{{URL::route('admin::profile')}}"><i class="fa fa-gears"></i> <span>@lang('Profile')</span> <i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li class="{{(Route::is('admin::profile') ? 'active ' : '')}}"><a href="{{URL::route('admin::profile')}}">@lang('Your Profile')</a></li>
						<li class="{{(Route::is('admin::log') ? 'active ' : '')}}"><a href="{{URL::route('admin::log')}}">@lang('Admin Logs')</a></li>
					</ul>
				</li>
			</ul>
			<!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				@yield('title')
				<small>@yield('description')</small>
			</h1>
			<ol class="breadcrumb">
				@section('breadcrumb')
				<li><a href="{{URL::route('admin::index')}}"><i class="fa fa-dashboard"></i>Home</a></li>
				@show
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			@yield('content')
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="pull-right hidden-xs">
			Rights Reserved! Powered by <a href="http://www.lianyue.org" target="_blank">LianYue</a>
		</div>
		<!-- Default to the left -->
		<strong>Copyright &copy; 2015 <a href="/">OtaMoe</a>.</strong> All rights reserved.
	</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->


@section('javascript')
<!-- jQuery 2.1.4 -->
<script type="text/javascript" src="{{URL::asset('/assets/jQuery/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script type="text/javascript" src="{{URL::asset('/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="{{URL::asset('/assets/admin/js/app.min.js')}}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
		 Both of these plugins are recommended to enhance the
		 user experience. Slimscroll is required when using the
		 fixed layout. -->
@show
</body>
</html>


