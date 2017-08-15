
{!! Form::open(['route' => $ruta, 'method' => 'POST', 'files' => true]) !!}
	@yield('content')
	<div class="form-group" align="right">
			{!! Form::submit('Entrar', ['class' => 'btn btn-primary', 'onclick' => 'getValue()']) !!}
			<input type="button" name="Cancelar" value="Cancelar" class="btn btn-danger" onClick="location.href='{{ route('auth.logout') }}'">
	</div>
{!! Form::close() !!}
