@extends('front.mainListado')
@section('menu')
	@include('front.templates.menumodules')
@endsection

@section('title', trans('userinterface.titles.LIST_COMPANIES'))

@section('content')
	<?php $ruta="mrp.years"?>
	@section('create')
		@include('front.templates.create')
	@endsection
	<table data-toggle="table" class="table table-striped">
		<thead>
			<th>{{ trans('userinterface.labels.YEAR') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
		</thead>
		<tbody>
			@foreach($years as $year)
				<tr>
					<td>{{ $year->id_year }}</td>
					<td>
						@if (! $year->is_closed)
								<span class="label label-success">{{ trans('userinterface.labels.OPENED') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.CLOSED') }}</span>
						@endif
					</td>
					<td>
						@if (! $year->is_deleted)
								<span class="label label-success">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $year;
								$sRoute = 'mrp.years';
								$iRegistryId = $year->id_company;
						?>
						@include('templates.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $years->render() !!}
@endsection
