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



@section('title', e($post->title))
@section('main-title', '新闻动态')
@section('keywords', implode(',', array_slice(array_merge([e($post->title), '新闻动态'], config('site.keywords')), 0, 8)))
@section('description', str_limit(str_replace(["\r", "\n", "\t", '\'', '"', '<', '>'], '', $post->excerpt), 128))


@section('breadcrumb')
	@parent
	<li><a href="{{URL::route('news.index')}}">新闻动态</a></li>
	<li class="active">内容</li>
@endsection



@section('content')
	<article class="content-news">
		<header class="entry-header">
			<h2 class="entry-title"><a href="{{URL::route('news.show', $post->id)}}" title="{{$post->title}}">{{$post->title}}</a></h2>
			<div class="entry-meta">
				<time class="entry-date" datetime="{{$post->created_at->format('c')}}" title="{{$post->created_at->format('c')}}"><i class="fa fa-clock-o"></i>{{$post->created_at->format('Y-m-d')}}</time>
			</div>
		</header>
		<div class="entry-content">
			{!!$post->content!!}
		</div>
	</article>
@endsection