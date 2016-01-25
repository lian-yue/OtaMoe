<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2016-01-16 06:22:24
/*
/* ************************************************************************** */
?>@extends('layouts.default')



@section('main')
<div class="main-head">
	<div class="container">
		<h2>@yield('main-title')</h2>
	</div>
</div>
<div class="main-body">
	<div class="container">
		<ol class="breadcrumb">
			@section('breadcrumb')
			<li><a href="{{URL::route('page.index')}}"><i class="fa fa-home" rel="home"></i>首页</a></li>
			@show
		</ol>
	</div>

	<div class="container">
		<div id="primary" class="content-area primary">
			<div id="content" class="content site-content"  role="main">
				@yield('content')
			</div>
		</div>
		<div id="sidebar" class="sidebar widget-area" role="complementary">
			{{-- <aside class="widget">
				<h3 class="widget-title">TEST</h3>
				<ul>
				</ul>
			</aside> --}}
		</div>
	</div>
</div>
@endsection