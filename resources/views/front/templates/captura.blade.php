
{!! Form::open(['route' => $ruta, 'method' => 'POST', 'files' => true]) !!}
	@yield('content')
	<div class="form-group" align="right">
			{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
			<input type="button" name="Cancelar" value="Cancelar" class="btn btn-danger" onClick="location.href='{{ route('users.index') }}'">
	</div>
{!! Form::close() !!}
