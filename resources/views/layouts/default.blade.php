<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-28 13:54:57
/*
/* ************************************************************************** */
use App\Page;

?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Cache-Control" content="no-transform" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>@if (Route::is('page.index')){{config('site.title') . ' - ' . config('site.subtitle')}}@else@yield('title') - {{config('site.title')}}@endif</title>
	<meta name="keywords" content="@yield('keywords', implode(',', config('site.keywords')))" />
	<meta name="description" content="@yield('description', config('site.description'))" />
	@section('style')
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link href="{{URL::asset('/assets/theme/css/main.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{URL::asset('/assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
	<!--[if lt IE 9]>
	<link href="{{URL::asset('/assets/theme/css/ie8.min.css')}}" rel="stylesheet" type="text/css" />
	<![endif]-->
	<!--[if lt IE 8]>
	<link href="{{URL::asset('/assets/theme/css/ie7.min.css')}}" rel="stylesheet" type="text/css" />
	<![endif]-->
	<!--[if lt IE 7]>
	<link href="{{URL::asset('/assets/theme/css/ie6.min.css')}}" rel="stylesheet" type="text/css" />
	<![endif]-->
	<!--[if lt IE 9]>
	<script type="text/javascript" src="{{URL::asset('/assets/html5shiv/html5shiv.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('/assets/respond/respond.min.js')}}"></script>
	<![endif]-->
	@show
	@section('javascript')
	<script type="text/javascript" src="{{URL::asset('/assets/theme/js/main.min.js')}}"></script>
	@show
</head>
<body>
	<div class="wrapper">
		<header id="header" class="main-header" role="banner">
			<div class="container">
				<h1 id="logo">
					<a href="{{URL::route('page.index')}}" title="{{config('site.title')}} | {{config('site.description')}}" rel="home">
						<span class="site-title">{{config('site.title')}}</span>
						<span class="site-description">Domain<span class="tld">.com</span></span>
					</a>
				</h1>

				<?php
					$menu = Page::menu();
				?>
				<nav id="navigation" class="primary-navigation" role="navigation">
					<button class="menu-toggle">@lang('Menu')</button>
					<div class="menu-container">
						<ul>
							<li class="{{(Route::is('page.index') ? 'active' : '')}}"><a href="{{URL::route('page.index')}}"  rel="home" title="@lang('Home')">@lang('Home')</a></li>
							@foreach($menu[0] as $value)
								<li class="{{(Request::is($value->slug) || Route::is('page.show') && $value->slug == Request::input('slug') ? 'active' : '')}} {{empty($menu[$value->id]) ? '' : 'dropdown'}}">
									<a href="{{$value->url ? $value->url : URL::route('page.show', $value->slug)}}" title="{{$value->name}}" {!!$value->url ? 'target="_blank"' : '' !!}>{{$value->name}}</a>
									@if (!empty($menu[$value->id]))
									<ul class="treeview-menu">
										@foreach($menu[$value->id] as $value2)
											<li class="{{(Request::is($value2->slug) || Route::is('page.show') && $value2->slug == Request::input('slug') ? 'active' : '')}}">
												<a href="{{$value2->url ? $value2->url : URL::route('page.show', $value2->slug)}}" title="{{$value2->name}}" {!!$value2->url ? 'target="_blank"' : '' !!}>{{$value2->name}}</a>
											</li>
										@endforeach
									</ul>
									@endif
								</li>
							@endforeach
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<div id="main" class="main">
			@yield('main')
			{{-- <div class="container">
				<div id="sidebar" class="sidebar" role="complementary">

				</div>
				<div id="content-wrapper" class="content-wrapper">
					<section class="content-header">
						@yield('content-header')
					</section>
					<section class="content">
						@yield('content')
					</section>
				</div>
			</div> --}}
		</div>
		<footer id="footer" role="contentinfo">
			<nav id="footer-navigation" class="footer-navigation">
				<div class="container">
				<h3>导航</h3>
					<ul>
						<li><a href="11">经营范围</a></li>
						<li><a href="11">法律声明</a></li>
						<li><a href="11">关于我们</a></li>
						<li><a href="11">宅萌文化</a></li>
						<li><a href="11">发展历程</a></li>
						<li><a href="11">联系我们</a></li>
						<li><a href="11">在线留言</a></li>
						<li><a href="11">公司新闻</a></li>
						<li><a href="11">公司项目</a></li>
					</ul>
				</div>
			</nav>
			<div id="copyright">
				<div class="container">
					<span><strong>Copyright &#169; 2015-2016 <a href="{{URL::route('page.index')}}">{{config('site.title')}}</a></strong> All Rights Reserved. Powered by <a href="http://www.lianyue.org" target="_blank" title="恋月 | LianYue">LianYue</a></span>
					@if(config('site.beian'))
						<span><a href="#" data-href="http://www.miitbeian.gov.cn/" target="_blank" class="replace-href">{{config('site.beian')}}</a></span>
					@endif
				</div>
			</div>
		</footer>
	</div>
</body>
</html>
