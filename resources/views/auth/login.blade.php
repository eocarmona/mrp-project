@extends('front.admin')

@section('title','Login')

@section('content')
	{!! Form::open(['route' => 'auth.login', 'method' => 'POST']) !!}
		<div class="form-group">
			{!! Form::label('username', 'Username') !!}
			{!! Form::input('text', 'username', null, ['class' => 'form-control', 'placeholder' => 'Nombre de usuario']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('password', 'Password') !!}
			{!! Form::password('password', ['class' => 'form-control', 'placeholder' => '**********']) !!}
		</div>
		<div class="form-group" align="right">
			{!! Form::submit('Acceder', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}

@endsection
