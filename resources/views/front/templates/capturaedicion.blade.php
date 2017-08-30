@if(isset($aux))
	{!! Form::open(['route' => [$ruta, $aux], 'method' => 'PUT']) !!}
	@yield('content')
	<div class="form-group" align="right">
		{!! Form::submit(trans('actions.EDIT'), ['class' => 'btn btn-primary']) !!}
@else
	{!! Form::open(['route' => $ruta, 'method' => 'POST']) !!}
	@yield('content')
	<div class="form-group" align="right">
		{!! Form::submit(trans('actions.SAVE'), ['class' => 'btn btn-primary']) !!}
@endif
	<input type="button" name="{{ trans('actions.CANCEL') }}" value="{{ trans('actions.CANCEL') }}" class="btn btn-danger" onClick="location.href='{{ route($ruta2) }}'">
	</div>
	{!! Form::close() !!}
