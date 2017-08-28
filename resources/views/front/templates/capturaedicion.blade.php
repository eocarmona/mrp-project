@if(isset($aux))
	{!! Form::open(['route' => [$ruta, $aux], 'method' => 'PUT']) !!}
	@yield('content')
	<div class="form-group" align="right">
		{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
@else
	{!! Form::open(['route' => $ruta, 'method' => 'POST']) !!}
	@yield('content')
	<div class="form-group" align="right">
		{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
@endif
	<input type="button" name="Cancelar" value="Cancelar" class="btn btn-danger" onClick="location.href='{{ route($ruta2) }}'">
	</div>
	{!! Form::close() !!}
