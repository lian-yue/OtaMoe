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
?>@extends('admin.layouts.default')


@section('title')
	@lang('Show Feedback')
@endsection




@section('breadcrumb')
	@parent
	<li><a href="{{URL::route('admin::feedback.index')}}">@lang('Feedbacks')</a></li>
	<li class="active">@lang('Show')</li>
@endsection





@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">@lang('Show Feedback')</h3>
			</div>
			<div class="box-body">
				<div class="form-group">
					<label class="control-label">@lang('ID:')</label>
					<input type="text" class="form-control" value="{{$feedback->id}}" readonly="readonly">
				</div>
				<div class="form-group">
					<label class="control-label">@lang('IP:')</label>
					<input type="text" class="form-control" value="{{$feedback->ip}}" readonly="readonly">
				</div>
				<div class="form-group">
					<label class="control-label">@lang('Created:')</label>
					<input type="text" class="form-control" value="{{$feedback->created_at}}" readonly="readonly">
				</div>
				<div class="form-group">
					<label class="control-label">@lang('URL:')</label>
					<input type="text" class="form-control" value="{{$feedback->url}}" readonly="readonly">
				</div>
				<div class="form-group">
					<label class="control-label">@lang('Contact:')</label>
					<input type="text" class="form-control" value="{{$feedback->contact_value ? $feedback->contact_type . ': ' . $feedback->contact_value : ''}}" readonly="readonly">
				</div>
				<div class="form-group">
					<label class="control-label">@lang('Content:')</label>
					<textarea class="form-control" rows="10" readonly="readonly">{{$feedback->content}}</textarea>
				</div>
			</div>
		</div>
</div>
</div>
@endsection