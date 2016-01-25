<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2016-01-16 06:41:36
/*
/* ************************************************************************** */
?>@extends('layouts.content')



@section('title', '新闻动态')
@section('main-title', '新闻动态')
@section('keywords', implode(',', array_slice(array_merge(['新闻动态', '新闻', '公司新闻', '动态', '公司动态'], config('site.keywords')), 0, 10)))


@section('breadcrumb')

	@parent
	<li class="active">新闻动态</li>
@endsection



@section('content')
@foreach($posts as $post)
	<article class="list-news">
		<header class="entry-header">
			<h2 class="entry-title"><a href="{{URL::route('news.show', $post->id)}}" title="{{$post->title}}">{{$post->title}}</a></h2>
		</header>
		<div class="entry-content"><p>{{$post->excerpt}}</p></div>
		<footer class="entry-meta">
			<time class="entry-date" datetime="{{$post->published_at->format('c')}}" title="{{$post->published_at->format('c')}}"><i class="fa fa-clock-o"></i>{{$post->published_at->format('Y-m-d')}}</time>
		</footer>
	</article>
@endforeach
<div class="clear"></div>
{!!$posts->render()!!}
@endsection