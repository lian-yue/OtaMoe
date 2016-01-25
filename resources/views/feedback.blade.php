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



@section('title', '在线留言')
@section('main-title', '在线留言')
@section('keywords', implode(',', array_slice(array_merge(['留言', '反馈', '留言反馈', '在线留言'], config('site.keywords')), 0, 8)))


@section('breadcrumb')
	@parent
	<li class="active">在线留言</li>
@endsection

@section('content')
	<div class="feedback">
		<form action="{{URL::route('feedback.store')}}" method="POST">
			@if (!empty($messages))
				<div class="callout callout-success">
					@foreach($messages as $message)
						<p>{{$message}}</p>
					@endforeach
				</div>
			@elseif (!empty($errors) && $errors->count())
				<div class="callout callout-danger">
					@foreach($errors->all() as $error)
						<p>{{$error}}</p>
					@endforeach
				</div>
			@endif
			<div class="form-group">
				<label for="contact_value" class="control-label">联系方式:</label>
				<select name="contact_type" type="text" maxlength="255" class="form-control" id="contact_type">
					@foreach(['email' => '(Email) 邮箱', 'phone' => '(Phone) 电话', 'qq' => 'QQ 号码'] as $type => $value)
					<option value="{{$type}}" {{old('contact_type') ==  $type ? 'selected' : ''}}>{{$value}}</option>
					@endforeach
				</select>
				<input name="contact_value" type="text" maxlength="255" value="{{old('contact_value')}}" class="form-control" id="contact_value">
			</div>
			<div class="form-group">
				<label for="feedback-content" class="control-label">消息内容:</label>
				<textarea name="content" type="text" maxlength="65535" value="" class="form-control" id="feedback-content">{{old('content')}}</textarea>
			</div>
			<div class="form-group">
				<button type="submit" class="form-control submit">提交</button>
				{!!csrf_field()!!}
			</div>
		</form>
	</div>
@endsection