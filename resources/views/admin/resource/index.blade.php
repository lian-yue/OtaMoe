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
	@lang($title['index'])
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
	<li><a href="{{URL::route('admin::' . $withName .'.index')}}">@lang($title['name'])</a></li>
	<li class="active">@lang('Index')</li>
@endsection




@section('content')

<?php
$sorts = [];
foreach($fields as $field) {
	if(!isset($field['methods']['index'])) {
		continue;
	}
	$sorts[$field['methods']['index']][] = $field;
}
ksort($sorts);
$array = [];
foreach ($sorts as $value) {
	$array = array_merge($array, $value);
}
?>

<div class="row">
	<div class="col-xs-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="{{!Request::has('filter') ? 'active' : ''}}"><a href="{{URL::route('admin::'. $withName .'.index')}}">@lang('Published')</a></li>
				<li class="{{Request::input('filter') == 'trashed' ? 'active' : ''}}"><a href="{{URL::route('admin::'. $withName .'.index', ['filter' => 'trashed'])}}">@lang('Trashed')</a></li>
			</ul>
			<div class="box-body">
				<div class="dataTables_wrapper">
					<div class="row">
						<div class="col-sm-12">
							<table id="{{$withName}}-index" class="table table-bordered table-striped dataTable">
								<thead>
									<tr>
										@section('thead')
											@foreach($array as $field)
												<th>@lang($field['title'])</th>
											@endforeach
											<th>@lang('Action')</th>
										@show
									</tr>
								</thead>
								<tbody>
									@section('tbody')
										@foreach($$withPosts as $value)
										<tr role="row">
											@foreach($array as $field)
												<td>
												@if(empty($field['callback']))
													<?php
														$showValue = $value->$field['name'];
													?>
												@else
													<?php
														$showValue = call_user_func_array($field['callback'], [$value, &$field, 'index']);
													?>
												@endif

												@if (in_array($field['type'], ['checkbox', 'select', 'radio']) && is_scalar($showValue) && isset($field['option'][$showValue]))
													{{$field['option'][$showValue]}}
												@else
													{{$showValue}}
												@endif
												</td>
											@endforeach
											<td>
											@if ($value->deleted_at)
												@if (Route::has('admin::'. $withName .'.restore'))
													<a href="{{URL::route('admin::'. $withName .'.restore', ['id'=> $value->id, '_token' => csrf_token()])}}">@lang('Restore')</a>
												@endif
											@else
												@if (Route::has('admin::'. $withName .'.show'))
													<a href="{{URL::route('admin::'. $withName .'.show', ['id'=> $value->id])}}">@lang('Show')</a> | 
												@endif
												@if (Route::has('admin::'. $withName .'.edit'))
													<a href="{{URL::route('admin::'. $withName .'.edit', ['id'=> $value->id])}}">@lang('Edit')</a> | 
												@endif
												@if (Route::has('admin::'. $withName .'.destroy'))
													<a href="{{URL::route('admin::'. $withName .'.destroy', ['id'=> $value->id, '_token' => csrf_token()])}}">@lang('Delete')</a>
												@endif
											@endif
											</td>
										</tr>
										@endforeach
									@show
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="dataTables_paginate paging_simple_numbers" id="{{$withName}}_paginate">
								{!!$$withPosts->render()!!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection