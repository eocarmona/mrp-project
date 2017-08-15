@extends('front.mainCapturaEdicion')
@if(isset($permission))
	<?php
			$ruta='permissions.update';
			$aux=$permission;
	?>
	@section('title', trans('userinterface.titles.EDIT_PERMISSION'))
@else
	<?php
		$ruta='permissions.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_PERMISSION'))
@endif
	<?php $ruta2='permissions.index' ?>

@section('content')

		<div class="form-group">
			{!! Form::label('name','Name') !!}
			{!! Form::text('name',isset($permission) ? $permission->name : null ,['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.NAME'), 'required']) !!}
		</div>

@endsection
