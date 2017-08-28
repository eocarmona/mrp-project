{!! Form::open(['route' => [ $ruta.'.index'],'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}
	<div class="input-group">
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar..', 'aria-describedby' => 'search']) !!}
		<span class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
	</div>
	<hr/>
	<div>
		{!! Form::select('filter', [
										 \Config::get('scsys.FILTER.ACTIVES') => trans('userinterface.labels.ACTIVES'),
										 \Config::get('scsys.FILTER.DELETED') => trans('userinterface.labels.INACTIVES'),
										 \Config::get('scsys.FILTER.ALL') => trans('userinterface.labels.ALL')
									 		],
											$iFilter, ['class' => 'form-control', 'required']) !!}
		{!! Form::button('<i class="glyphicon glyphicon-filter"></i>', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
	</div>
{!! Form::close() !!}
