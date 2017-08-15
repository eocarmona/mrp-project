<a href={{  route($ruta.'.create') }} class="btn btn-success btn-min" style="visibility: {{ App\SUtils\SValidation::isRendered(\Config::get('constants.OPERATION.CREATE'), $actualUserPermission, 0) }};">Crear</a>
{!! Form::open(['route' => [ $ruta.'.index'],'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}
	<div class="input-group">
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar..', 'aria-describedby' => 'search']) !!}
		<span class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
	</div>
	<hr/>
	<div>
		{!! Form::select('filter', [
										 \Config::get('constants.FILTER.ACTIVES') => 'Activos',
										 \Config::get('constants.FILTER.DELETED') => 'Inactivos',
										 \Config::get('constants.FILTER.ALL') => 'Todos'
									 		],
											$iFilter, ['class' => 'form-control', 'required']) !!}
		{!! Form::button('<i class="glyphicon glyphicon-filter"></i>', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
	</div>
{!! Form::close() !!}
