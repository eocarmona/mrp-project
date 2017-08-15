@extends('front.mainCapturaEdicion')
@if(isset($privilege))
	<?php
			$ruta='privileges.update';
			$aux=$privilege;
	?>
	@section('title', trans('userinterface.titles.EDIT_PRIVILEGE'))
@else
	<?php
		$ruta='privileges.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_PRIVILEGE'))
@endif
	<?php $ruta2='privileges.index' ?>

@section('content')


		<div class="form-group">
			{!! Form::label('name','Name') !!}
			{!! Form::text('name',isset($privilege) ? $privilege->name : null ,['class'=>'form-control', 'placeholder' => 'Nombre del privilegio','required']) !!}
		</div>

@endsection
