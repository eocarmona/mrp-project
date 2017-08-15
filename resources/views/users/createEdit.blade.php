@extends('front.mainCapturaEdicion')
@if(isset($user))
	<?php
			$ruta='users.update';
			$aux=$user;
	?>
	@section('title', trans('userinterface.titles.EDIT_USER'))
@else
	<?php
		$ruta='users.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_USER'))
@endif
	<?php $ruta2='users.index' ?>

@section('content')


		<div class="form-group">
			{!! Form::label('username', trans('userinterface.labels.NAME')) !!}
			{!! Form::text('username',
				isset($user) ? $user->username : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.NAME'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email', trans('userinterface.labels.EMAIL')) !!}
			{!! Form::email('email',isset($user) ? $user->email : null ,['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.EMAIL'), 'required']) !!}
		</div>

		@if(! isset($user))
			<div class="form-group">
				{!! Form::label('password', trans('userinterface.labels.PASSWORD')) !!}
				{!! Form::password('password', ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.PASSWORD'), 'required']) !!}
			</div>
		@endif

		<div class="form-group">
			{!! Form::label('type_id', trans('userinterface.labels.TYPE')) !!}
			{!! Form::select('type_id', $types, isset($user) ? $user->type_id : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.SELECT_TYPE'), 'required']) !!}
		</div>


@endsection
