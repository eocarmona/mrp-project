
{!! Form::open(['route' => $ruta, 'method' => 'POST', 'files' => true]) !!}
	@yield('content')
	<div class="form-group" align="right">
			{!! Form::submit( trans('actions.SAVE'), ['class' => 'btn btn-primary']) !!}
			<input type="button" name="{{ trans('actions.CANCEL') }}" value="{{ trans('actions.CANCEL') }}" class="btn btn-danger" onClick="location.href='{{ route('users.index') }}'">
	</div>
{!! Form::close() !!}
