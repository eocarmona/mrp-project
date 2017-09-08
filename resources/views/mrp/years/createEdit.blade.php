@extends('front.mainCapturaEdicion')
@if(isset($year))
	<?php
			$ruta = 'mrp.years.update';
			$aux = $year;
	?>
	@section('title', trans('userinterface.titles.EDIT_BRANCH'))
@else
	<?php
		$ruta='mrp.years.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_BRANCH'))
@endif
	<?php $ruta2 = 'mrp.years.index' ?>

@section('content')

		<div class="form-group">
			{!! Form::label('year_id', trans('userinterface.labels.BRANCH')) !!}
			{!! Form::number('year_id',
				isset($year) ? $year->year_id : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.BRANCH'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('is_closed', trans('userinterface.labels.CODE')) !!}
			{!! Form::checkbox('is_closed',
				isset($year) ? $year->is_closed : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.CODE'), 'required']) !!}
		</div>

@endsection
