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



@section('title', e($post->name))
@section('main-title', '产品项目')
@section('keywords', implode(',', array_slice(array_merge([e($post->name), '项目产品'], config('site.keywords')), 0, 8)))
@section('description', str_limit(str_replace(["\r", "\n", "\t", '\'', '"', '<', '>'], '', $post->excerpt), 128))


@section('breadcrumb')
	@parent
	<li><a href="{{URL::route('project.index')}}">产品项目</a></li>
	<li class="active">{{$post->name}}</li>
@endsection



@section('content')
	<article class="content-project">
		<header class="entry-header">
			<h2 class="entry-title"><a href="{{URL::route('project.show', $post->slug)}}" title="{{$post->name}}">{{$post->name}}</a></h2>
			<div class="entry-meta">
				<time class="entry-date" datetime="{{$post->created_at->format('c')}}" title="{{$post->created_at->format('c')}}"><i class="fa fa-clock-o"></i>{{$post->created_at->format('Y-m-d')}}</time>
				<span class="project-url"><a href="{{$post->url}}"  target="_blank"><i class="fa fa-link"></i>{{preg_replace('/^https?\:\/\/(?:www\.)?([0-9a-z_.-]+).*?$/i', '$1', $post->url)}}</a></span>
				<span class="project-self"><i class="fa fa-sticky-note-o"></i>{{$post->self ? '自有项目' : '合作项目'}}</span>
			</div>
		</header>
		<div class="entry-content">
			{!!$post->content!!}
		</div>
	</article>
@endsection