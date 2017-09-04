@extends('front.mainCapturaEdicion')
<?php
    $ruta='mrp.companies.update';
    $aux=$company;
?>

@section('title', trans('userinterface.titles.EDIT_COMPANY'))
<?php $ruta2='mrp.companies.index' ?>

@section('content')


		<div class="form-group">
			{!! Form::label('name', trans('userinterface.labels.COMPANY')) !!}
			{!! Form::text('name',
				isset($company) ? $company->name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.COMPANY'), 'required']) !!}
		</div>
    <br />



@endsection
