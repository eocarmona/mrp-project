@extends('front.mainCapturaEdicion')
@if(isset($year))
	<?php
			$sRoute = 'mrp.years.update';
			$aux = $year;
	?>
	@section('title', trans('userinterface.titles.EDIT_YEAR'))
@else
	<?php
		$sRoute='mrp.years.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_YEAR'))
@endif
	<?php $sRoute2 = 'mrp.years.index' ?>

@section('content')

		<div class="form-group">
			{!! Form::label('id_year', trans('userinterface.labels.YEAR')) !!}
			{!! Form::number('id_year',
				isset($year) ? $year->id_year : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.YEAR'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('is_closed', trans('userinterface.labels.CLOSED')) !!}
			{!! Form::checkbox('is_closed', 1, isset($year) ? $year->is_closed : false) !!}
		</div>

@endsection
