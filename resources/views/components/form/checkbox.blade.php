@php
/*
@component('components.form.checkbox')@endcomponent
========
Example:
========
@component('components.form.checkbox', [
	'is_view'    => $is_view,
	'required'   => true,
	'label'      => 'เลขประจำตัวประชาชน/เลขหนังสือเดินทาง ID Card number/Passport Number',
	'name'       => 'id_card',
	'value'      => $user->id_card,
	'attributes' => [
		'class'       => 'form-control', 
		'placeholder' => 'เลขประจำตัวประชาชน/เลขหนังสือเดินทาง ID Card number/Passport Number',
		'maxlength'   => 13,
		'autofocus'
	]
])
@endcomponent
*/
	$is_view = isset($is_view) ? $is_view : false ;
	$required = isset($required) ? $required : false;
	$attributes = isset($attributes) ? $attributes : [] ;
	$labe = @$labe;
	$name = @$name;
	$value = @$value;
	// set default attributes.
	$attributes['class']       = 'form-control '
		.($errors->has($name) ? ' is-invalid' : null)
		.@$attributes['class']; 
	$attributes['placeholder'] = isset($attributes['placeholder']) ? $attributes['placeholder'] : $label ;
@endphp
<div class="form-group">
    {{ Form::label($name, $label) }} 
	<div>
		{!! $required ? '&nbsp;<span class="text-danger">*</span>' : '' !!}
		@if ($is_view)
			<div style="line-height:2.5rem; padding:0 0.5rem;">
				{{ $value }}
			</div>
		@else
			{{ Form::checkbox($name, $value, $attributes) }}
		@endif
		{!! $errors->first($name, '<span class="invalid-feedback d-block">:message</span>') !!}
	</div>
</div>
