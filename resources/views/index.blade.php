<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-11 06:11:02
/*
/* ************************************************************************** */
use App\Page;
use App\Project;
?>@extends('layouts.default')
@section('keywords', e(implode(',', config('site.keywords'))))
@section('description', config('site.description'))

@section('main')
<section id="index-banner"  class="index-banner index-section">
	<div class="index-content">
		<div class="container">
			<div class="banner">
				<h1>死宅创世纪，万物皆可萌</h1>
				<div class="btn"><a href="{{URL::route('page.show', 'contact')}}"><span>联系我们</span></a></div>
			</div>
		</div>
	</div>
</section>


<section id="index-service" class="index-service index-section">
	<div class="index-title">
		<div class="container">
			<h2>宅萌科技是一家专注于二次元项目的公司。<br>专业的二次元技术团队。</h2>
		</div>
	</div>
	<div class="index-content">
		<div class="container">
			<ul>
				@foreach(Page::home() as $i => $post)
					<li class="i-{{$i}}">
						<div class="icon"><a href="{{URL::route('page.show', $post->slug)}}" title="{{$post->name}}"><i class="fa fa-{{$post->icon}}"></i></a></div>
						<h3><a href="{{URL::route('page.show', $post->slug)}}" title="{{$post->name}}">{{$post->name}}</a></h3>
						<p>{{$post->excerpt}}</p>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</section>

<section id="index-project"  class="index-project index-section">
	<div class="index-title">
		<div class="container">
			<h2><a href="{{URL::route('project.index')}}">项目展示</a></h2>
		</div>
	</div>
	<div class="index-content">
		<div class="container">
			<ul>
				@foreach((new Project)->orderBy('sort', 'ASC')->limit(8)->get() as $post)
					<li>
						<div class="logo"><a href="{{URL::route('project.show', $post->slug)}}" title="{{$post->name}}" rel="bookmark"><img src="{{$post->logo}}" title="{{$post->name}}" ait="{{$post->name}}"/></a></div>
						<h3><a href="{{URL::route('project.show', $post->slug)}}" title="{{$post->name}}" rel="bookmark">{{$post->name}}</a></h3>
						<p>{{$post->excerpt}}</p>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</section>



@endsection