@extends('front.mainCapturaEdicion')
@if(isset($permission))
	<?php
			$sRoute='permissions.update';
			$aux=$permission;
	?>
	@section('title', trans('userinterface.titles.EDIT_PERMISSION'))
@else
	<?php
		$sRoute='permissions.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_PERMISSION'))
@endif
	<?php $sRoute2='permissions.index' ?>

@section('content')

		<div class="form-group">
			{!! Form::label('name','Name') !!}
			{!! Form::text('name',isset($permission) ? $permission->name : null ,['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.NAME'), 'required']) !!}
		</div>

@endsection
