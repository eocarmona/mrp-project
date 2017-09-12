@extends('front.mainCapturaEdicion')
@if(isset($branch))
	<?php
			$sRoute = 'mrp.branches.update';
			$aux = $branch;
	?>
	@section('title', trans('userinterface.titles.EDIT_BRANCH'))
@else
	<?php
		$sRoute='mrp.branches.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_BRANCH'))
@endif
	<?php $sRoute2 = 'mrp.branches.index' ?>

@section('content')

		<div class="form-group">
			{!! Form::label('code', trans('userinterface.labels.CODE')) !!}
			{!! Form::text('code',
				isset($branch) ? $branch->code : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.CODE'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('name', trans('userinterface.labels.BRANCH')) !!}
			{!! Form::text('name',
				isset($branch) ? $branch->name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.BRANCH'), 'required']) !!}
		</div>

@endsection
