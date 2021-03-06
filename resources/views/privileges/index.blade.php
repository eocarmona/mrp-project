@extends('front.mainListado')

@section('menu')
	@include('front.templates.menu')
@endsection

@section('title', trans('userinterface.titles.LIST_PRIVILEGES'))

@section('content')
	<?php $sRoute="privileges"?>
	@section('create')
		@include('front.templates.create')
	@endsection
	<table class="table table-striped">
		<thead>
			<th>{{ trans('userinterface.labels.NAME') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
		</thead>
		<tbody>
			@foreach($privileges as $privilege)
				<tr>
					<td>{{ $privilege->name }}</td>
					<td>
						@if (! $privilege->is_deleted)
								<span class="label label-success">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $privilege;
								$sRoute = 'privileges';
								$iRegistryId = $privilege->id_privilege;
						?>
						@include('front.listed.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $privileges->render() !!}
@endsection
