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
	@lang(empty($$withPost) ? $title['create'] : (empty($withShow) ? $title['update'] : $title['show']))
@endsection

@section('javascript')
	@parent
	<script type="text/javascript" src="{{URL::asset('/assets/ckeditor/ckeditor.js')}}"></script>
	<script type="text/javascript">
		$(function () {
			$('[upload]').each(function() {
				var name = $(this).attr('name');
				$(this).parents('.form-group').after('<div class="form-group file-container" data-name="'+ name +'">\
									<div class="row">\
										<div class="col-sm-2" style="width:auto">\
											<div id="file-input-'+ name +'" class="btn btn-default btn-file"><i class="fa fa-paperclip"></i> Attachment</div>\
										</div>\
										<div class="col-sm-6">\
											<div class="progress" style="margin: 7px 0 0 0;display:none"><div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" style="width: 0%"></div></div>\
										</div>\
										<div class="col-sm-4" style="vertical-align:middle">\
											<div class="progress-error text-red" style="margin: 6px 0 0 0;"></div>\
										</div>\
									</div>\
								</div>');
			});
			if ($('.file-container').size()) {
				$.ajax({
					dataType: "script",
				    cache: true,
				    url: "{{URL::asset('/assets/Plupload/js/plupload.full.min.js')}}",
				    success: function() {
				    	$('.file-container').each(function() {
				    		var container = this;
				    		var name = $(container).attr('data-name');
							var uploader = new plupload.Uploader({
								runtimes : 'html5,flash,html4,silverlight',
								browse_button : 'file-input-' + name,
								container: container,
								multi_selection: false,
								url : "{{URL::route('admin::file.store')}}",
								flash_swf_url : "{{URL::asset('/assets/Plupload/js/Moxie.swf')}}",
								silverlight_xap_url : "{{URL::asset('/assets/Plupload/js/Moxie.xap')}}",
								multipart_params : {_token :$('[name="csrf-token"]').attr('content'), json:true},
								headers : {'X-Requested-With': 'XMLHttpRequest'},
								init: {
									FilesAdded: function(up, files) {
										$(container).find('.progress').addClass('active').show().find('.progress-bar').width(0);
										$(container).find('.progress-error').text('');
										uploader.start();
									},

									UploadProgress: function(up, file) {
										$(container).find('.progress').addClass('active').show().find('.progress-bar').css('width', file.percent + '%');
									},

									Error: function(up, err) {
										$(container).find('.progress').removeClass('active');
										$(container).find('.progress-error').text(err.message);
										var response = $.parseJSON(err.response);
										if (response) {
											for (var k in response) {
												$(container).find('.progress-error').text(response[k]);
												break;
											}
										}
									},
									FileUploaded: function(up, file, content) {
										$(container).find('.progress').removeClass('active');
										var response = $.parseJSON(content.response);
										var input = $('[name="'+ name +'"]');
										if (input.is('textarea')) {
											var html = $('<a></a>').attr({href : response.url, target:'_blank', 'data-file-id' : response.id});
											var isImage = $.inArray(response.mime, ['image/jpeg', 'image/png', 'image/gif']) != -1;
											if (isImage) {
												html.html($('<img>').attr({src: response.url, title: response.name}));
											} else {
												html.text(response.name);
											}
											if (input.attr('editor')) {
												var editor = CKEDITOR.instances[name];
												var selectionValue = editor.getSelection().getSelectedText();
												if (selectionValue) {
													if (isImage) {
														html.append(selectionValue);
													} else {
														html.text(selectionValue);
													}
												}
												editor.insertHtml(html.prop("outerHTML"));
											} else {
												var textarea = input.get(0);
												textarea.focus();
												if (typeof(textarea.selectionStart) == 'number' && typeof(textarea.selectionEnd) == 'number') {
													var selectionStart = textarea.selectionStart;
													if (textarea.selectionStart != textarea.selectionEnd) {
														var selectionValue = textarea.value.substr(textarea.selectionStart, textarea.selectionEnd - textarea.selectionStart);
														if (isImage) {
															html.append(selectionValue);
														} else {
															html.text(selectionValue);
														}
														textarea.value = textarea.value.substr(0, textarea.selectionStart) + textarea.value.substr(textarea.selectionEnd);
														textarea.setSelectionRange(selectionStart, selectionStart);
													}
													html = html.prop("outerHTML");
													textarea.value = textarea.value.substr(0, textarea.selectionStart) + html +  textarea.value.substr(textarea.selectionEnd);
													textarea.setSelectionRange(selectionStart, selectionStart+ html.length);
												} else {
													textarea.value += html;
												}
											}
										} else {
											input.val(response.url);
										}
									}
								}
							});
							uploader.init();
						});
				    }
				});
			}




			$('textarea[editor]').each(function() {
				CKEDITOR.replace($(this).attr('name'));
			});
		});
	</script>
@endsection




@section('breadcrumb')
	@parent
	<li><a href="{{URL::route('admin::' . $withName .'.index')}}">@lang($title['name'])</a></li>
	<li class="active">@lang(empty($$withPost) ? 'Create' : (empty($withShow) ? 'Edit' : 'Show'))</li>
@endsection


@section('content')

<?php
$sorts = [];
foreach($fields as $field) {
	if(!isset($field['methods'][empty($$withPost) ? 'create' : (empty($withShow) ? 'update': 'show')])) {
		continue;
	}
	if (!empty($withShow)) {
		$field['readonly'] = true;
	}
	$sorts[$field['methods'][empty($$withPost) ? 'create' : (empty($withShow) ? 'update': 'show')]][] = $field;
}

ksort($sorts);
$array = [];
foreach ($sorts as $value) {
	$array = array_merge($array, $value);
}

$multipart = '';
foreach ($array as $form) {
	if (!empty($form['type']) && $form['type'] =='file') {
		$multipart = 'enctype="multipart/form-data"';
		break;
	}
}


$attributes = function(array $a, array $in = []) {
	$r = '';
	foreach ($a as $k => $v) {
		if ( in_array($k, ['label', 'legend', 'title', 'methods', 'callback']) || in_array($k, $in) || (!$v && !in_array($k, ['value', 'min', 'max']))) {
			continue;
		}
		$v = is_array($v) || is_object($v) ? reset($v) : $v;
		$r .= ' '. $k .'="'. $v .'"';
	}
	return $r;
}

?>
@if (!empty($errors) && $errors->count())
	<div class="callout callout-danger">
		@foreach($errors->all() as $error)
			<p>{{$error}}</p>
		@endforeach
	</div>
@endif

@if (empty($withShow))
	<form action="{{isset($$withPost->id) ? URL::route('admin::'. $withName .'.update', ['id' => $$withPost->id]) : URL::route('admin::'. $withName .'.store')}}" {!!$multipart!!} method="POST">
@endif
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">@lang(empty($$withPost) ? $title['create'] : (empty($withShow) ? $title['update'] : $title['show']))</h3>
				</div>
				<div class="box-body">
					@section('form')
						@foreach($array as $form)
							@if (!empty($form['callback']))
								<?php
									$form['value'] = call_user_func_array($form['callback'], [empty($$withPost) ? NULL : $$withPost, &$form, empty($$withPost) ? 'create' : (empty($withShow) ? 'update': 'show')]);
								?>
							@elseif (!empty($$withPost))
								@if (isset($$withPost->$form['name']))
									<?php
										$form['value'] = $$withPost->$form['name'];
									?>
								@endif
							@elseif (Request::old($form['name']) !== null)
								<?php
									$form['value'] = Request::old($form['name']);
								?>
							@elseif (!isset($form['value']))
								<?php
									$form['value'] = NULL;
								?>
							@endif
							<?php
							if (empty($form['class'])) {
								$form['class'] = '';
							}
							$form['class'] .= ' form-control';
							$form['class'] = trim($form['class']);
							if (empty($form['id'])) {
								$form['id'] = $form['name'];
							}
							 ?>
							<div class="form-group">
								<label for="{{$form['id']}}" class="control-label">{{isset($form['required']) ? '* ' : ''}}@lang($form['title'] . ':')</label>
								@if ($form['type'] === 'textarea')
									<textarea{!!$attributes($form, ['value'])!!}>{{isset($form['value']) ? $form['value'] : ''}}</textarea>
								@elseif ($form['type'] === 'button')
									<button{!!$attributes($form, ['value'])!!}>@lang(isset($form['value']) ? $form['value'] : 'Button')</button>
								@elseif ($form['type'] === 'select')
									<?php
									if (isset($form['multiple'])) {
										$form['name'] .= '[]';
									}
									?>
									<select{!!$attributes($form, ['value', 'option'])!!}>
										@foreach(empty($form['option']) ? [] : (array) $form['option'] as $key => $value)
											<option value="{{$key}}" {{isset($form['value']) && in_array($key, (array)$form['value']) ? 'selected="selected"' : ''}}>@lang($value)</option>
										@endforeach
									</select>
								@elseif ($form['type'] === 'checkbox')
									<input type="hidden" name="{{$form['name']}}[]" selected="selected" />
									@foreach (empty($form['option']) ? [] : $form['option'] as $key => $value)
										<div class="checkbox">
											<label for="{{$form['id']}}-{{$key}}" class="control-label">
												<input type="{{$form['type']}}" name="{{$form['name']}}[]" id="{{$form['id']}}-{{$key}}" value="{{$key}}"  {!!isset($form['value']) && in_array($key, (array)$form['value']) ? 'checked="checked"' : ''!!} {!!empty($form['readonly']) ? '' : 'readonly="readonly"'!!} />
												@lang($value)
											</label>
										</div>
									@endforeach
								@elseif ($form['type'] === 'radio')
									@foreach (empty($form['option']) ? [] : $form['option'] as $key => $value)
										<div class="radio">
											<label for="{{$form['id']}}-{{$key}}" class="control-label">
												<input type="{{$form['type']}}" name="{{$form['name']}}" id="{{$form['id']}}-{{$key}}" value="{{$key}}" {!!$form['value'] == $key ? 'checked="checked"' : ''!!}  {!!empty($form['readonly']) ? '' : 'readonly="readonly"'!!}/>
												@lang($value)
											</label>
										</div>
									@endforeach
								@elseif ($form['type'] === 'password')
									<input{!!$attributes($form, empty($$withPost) ? ['value'] : ['value', 'required'])!!} />
								@elseif ($form['type'] === 'datetime')
									<?php
										$form['type'] = 'datetime-local';
										if (!empty($form['value']) && is_object($form['value'])) {
											$form['value'] = $form['value']->format('Y-m-d\TH:i:s');
										}
									?>
									<input{!!$attributes($form)!!} />
								@elseif ($form['type'] === 'callback')
									{!!$form['value']!!}
								@else
									<input{!!$attributes($form)!!} />
								@endif
							</div>
						@endforeach
					@show
				</div>
				<div class="box-footer">
					@if (empty($withShow))
						<button type="submit" class="btn btn-primary">@lang('Submit')</button>
					@endif
				</div>
			</div>
		</div>
		@if (!empty($$withPost))
			<input type="hidden" name="_method" value="PUT">
		@endif
		{!!csrf_field()!!}
	</div>
@if (empty($withShow))
	</form>
@endif
@endsection