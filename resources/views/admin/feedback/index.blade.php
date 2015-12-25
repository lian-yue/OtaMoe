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
	@lang('All Feedbacks')
@endsection



@section('style')
	@parent
	<link rel="stylesheet" href="{{URL::asset('/assets/datatables/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('javascript')
	@parent
	<script type="text/javascript" src="{{URL::asset('/assets/datatables/js/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('/assets/datatables/js/dataTables.bootstrap.min.js')}}"></script>
@endsection



@section('breadcrumb')
	@parent
	<li><a href="{{URL::route('admin::feedback.index')}}">@lang('Feedbacks')</a></li>
	<li class="active">@lang('Index')</li>
@endsection





@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="{{!Request::has('filter') ? 'active' : ''}}"><a href="{{URL::route('admin::feedback.index')}}">@lang('Unread')</a></li>
				<li class="{{Request::input('filter') == 'read' ? 'active' : ''}}"><a href="{{URL::route('admin::feedback.index', ['filter' => 'read'])}}">@lang('Read')</a></li>
				<li class="{{Request::input('filter') == 'trashed' ? 'active' : ''}}"><a href="{{URL::route('admin::feedback.index', ['filter' => 'trashed'])}}">@lang('Trashed')</a></li>
			</ul>
			<div class="box-body">
				<div class="dataTables_wrapper">
					<div class="row">
						<div class="col-sm-12">
							<table id="news-index" class="table table-bordered table-striped dataTable">
							<thead>
								<tr>
									<th>@lang('ID')</th>
									<th>@lang('Type')</th>
									<th>@lang('Content')</th>
									<th>@lang('IP')</th>
									<th>@lang('Created')</th>
									<th>@lang('Action')</th>
								</tr>
							</thead>
							<tbody>
							@foreach($feedbacks as $feedback)
								<tr role="row">
									<td>{{$feedback->id}}</td>
									<td>{{$feedback->type}}</td>
									<td>{{str_limit($feedback->content, 32)}}</td>
									<td>{{$feedback->ip}}</td>
									<td>{{$feedback->created_at}}</td>
									<td>
									@if ($feedback->deleted_at)
										<a href="{{URL::route('admin::feedback.restore', ['id'=> $feedback->id, '_token' => csrf_token()])}}">@lang('Restore')</a> | 
									@else
										<a href="{{URL::route('admin::feedback.show', ['id'=> $feedback->id])}}">@lang('Show')</a>
										@if ($feedback->status)
											 | <a href="{{URL::route('admin::feedback.unread', ['id'=> $feedback->id, '_token' => csrf_token()])}}">@lang('Unread')</a>
										@else
											 | <a href="{{URL::route('admin::feedback.read', ['id'=> $feedback->id, '_token' => csrf_token()])}}">@lang('Read')</a>
										@endif
										 | <a href="{{URL::route('admin::feedback.destroy', ['id'=> $feedback->id, '_token' => csrf_token()])}}">@lang('Delete')</a>
									@endif
									</td>
								</tr>
							@endforeach
							</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="dataTables_paginate paging_simple_numbers" id="news_paginate">
								{!!$feedbacks->render()!!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection