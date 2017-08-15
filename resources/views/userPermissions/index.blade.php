@extends('front.mainListado')

@section('title', trans('userinterface.titles.LIST_ASSIGNAMENTS'))

@section('content')
	<?php $ruta="userPermissions"?>
	<table class="table table-striped">
		<thead>
			<th>Usuario</th>
			<th>Permiso</th>
      <th>Privilegio</th>
      <th>Acciones</th>
		</thead>
		<tbody>
			@foreach($userPermissions as $userPermission)
				<tr>
					<td>{{ $userPermission->user->username }}</td>
					<td>{{ $userPermission->permission->name }}</td>
					<td>{{ $userPermission->privilege->name }}</td>
					<td>
						@if ($userPermission->is_deleted == \Config::get('constants.STATUS.INACTIVE'))
								<span class="label label-success">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $userPermission;
								$sRoute = 'assignaments';
								$iRegistryId = $privilege->id_privilege;
						?>
						@include('templates.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $userPermissions->render() !!}
@endsection
