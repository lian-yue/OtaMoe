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
	@lang('Profile')
@endsection





@section('breadcrumb')
	@parent
	<li><a href="{{URL::route('admin::profile')}}">@lang('Profile')</a></li>
	<li class="active">@lang('Your')</li>
@endsection



@section('content')
	@if (!empty($errors) && $errors->count())
	<div class="callout callout-danger">
		@foreach($errors->all() as $error)
			<p>{{$error}}</p>
		@endforeach
	</div>
@endif
<form action="{{URL::route('admin::profile')}}" method="POST" >
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">@lang('Your Profile')</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label for="password" class="control-label">@lang('Nickname:')</label>
						<input name="nickname" type="text" required="1" value="{{Auth()->user()->nickname}}" class="form-control" id="nickname">
					</div>
					<div class="form-group">
						<label for="password_old" class="control-label">@lang('Old password:')</label>
						<input name="password_old" type="password" value="" class="form-control" id="password_old">
					</div>
					<div class="form-group">
						<label for="password" class="control-label">@lang('Password:')</label>
						<input name="password" type="password" value="" class="form-control" id="password">
					</div>
					<div class="form-group">
						<label for="password_confirmation" class="control-label">@lang('Confirm password:')</label>
						<input name="password_confirmation" type="password" value="" class="form-control" id="password">
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">@lang('Submit')</button>
				</div>
			</div>
		</div>
		{!!csrf_field()!!}
	</form>
</div>
@endsection