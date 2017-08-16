@extends('front.mainListado')

@section('title', trans('userinterface.titles.LIST_PERMISSIONS'))

@section('content')
	<?php $ruta="permissions"?>
	<table class="table table-striped">
		<thead>
			<th>{{ trans('userinterface.labels.NAME') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
		</thead>
		<tbody>
			@foreach($permissions as $permission)
				<tr>
					<td>{{ $permission->name }}</td>
					<td>
						@if ($permission->is_deleted == \Config::get('constants.STATUS.ACTIVE'))
								<span class="label label-success">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $permission;
								$sRoute = 'permissions';
								$iRegistryId = $permission->id_permission;
						?>
						@include('templates.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $permissions->render() !!}
@endsection
