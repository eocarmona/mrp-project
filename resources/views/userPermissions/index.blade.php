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
						<?php
								$oRegistry = $userPermission;
								$sRoute = 'userPermissions';
								$iRegistryId = $userPermission->id_privilege;
						?>
						@include('templates.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $userPermissions->render() !!}
@endsection
