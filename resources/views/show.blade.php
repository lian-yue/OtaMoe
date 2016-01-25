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
@section('main-title', e($post->name))
@section('keywords', implode(',', array_slice(array_merge([e($post->name)], config('site.keywords')), 0, 8)))
@section('description', str_limit(str_replace(["\r", "\n", "\t", '\'', '"', '<', '>'], '', $post->excerpt), 128))


@section('breadcrumb')
	@parent
	<li class="active">{{$post->name}}</li>
@endsection



@section('content')
	<article class="content-page">
		<header class="entry-header">
			<h2 class="entry-title">
				{{$post->name}}
			</h2>
		</header>
		<div class="entry-content">
			{!!$post->content!!}
		</div>
	</article>
@endsection