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
	@lang('Logs')
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
	<li><a href="{{URL::route('admin::profile')}}">@lang('Profile')</a></li>
	<li class="active">@lang('Logs')</li>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">@lang('Your Profile')</h3>
			</div>
			<div class="box-body">
				<div class="dataTables_wrapper">
					<div class="row">
						<div class="col-sm-12">
							<table id="news-index" class="table table-bordered table-striped dataTable">
							<thead>
								<tr>
									<th>@lang('ID')</th>
									<th>@lang('Type')</th>
									<th>@lang('Date')</th>
								</tr>
							</thead>
							<tbody>
							@foreach($logs as $log)
								<tr role="row">
									<td>{{$log->id}}</td>
									<td>{{$log->type}}</td>
									<td>{{$log->created_at}}</td>
								</tr>
							@endforeach
							</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="dataTables_paginate paging_simple_numbers" id="news_paginate">
								{!!$logs->render()!!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection