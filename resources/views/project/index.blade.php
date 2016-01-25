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



@section('title', '产品项目')
@section('main-title', '产品项目')
@section('keywords', implode(',', array_slice(array_merge(['产品', '项目', '应用', '产品项目'], config('site.keywords')), 0, 10)))


@section('breadcrumb')

	@parent
	<li class="active">产品项目</li>
@endsection



@section('content')
@foreach($posts as $post)
	<article class="list-project">
		<div class="logo"><a href="{{URL::route('project.show', $post->slug)}}" title="{{$post->name}}" rel="bookmark"><img src="{{$post->logo}}" title="{{$post->name}}" ait="{{$post->name}}"/></a></div>
		<header class="entry-header">
			<h2 class="entry-title"><a href="{{URL::route('project.show', $post->slug)}}" title="{{$post->name}}">{{$post->name}}</a></h2>
			<div class="entry-meta">
				<time class="entry-date" datetime="{{$post->created_at->format('c')}}" title="{{$post->created_at->format('c')}}"><i class="fa fa-clock-o"></i>{{$post->created_at->format('Y-m-d')}}</time>
				<span class="project-url"><a href="{{$post->url}}"  target="_blank"><i class="fa fa-link"></i>{{preg_replace('/^https?\:\/\/(?:www\.)?([0-9a-z_.-]+).*?$/i', '$1', $post->url)}}</a></span>
				<span class="project-self"><i class="fa fa-sticky-note-o"></i>{{$post->self ? '自有项目' : '合作项目'}}</span>
			</div>
		</header>
		<div class="entry-content"><p>{{$post->excerpt}}</p></div>
	</article>
@endforeach
<div class="clear"></div>
{!!$posts->render()!!}
@endsection