@extends('front.mainListado')

@section('title', trans('userinterface.titles.LIST_ASSIGNAMENTS'))

@section('content')
	<?php $ruta="userPermissions"?>
	@section('create')
		@include('front.templates.create')
	@endsection
	<table data-toggle="table" class="table table-striped">
		<thead>
			<th data-sortable="true">Usuario</th>
			<th data-sortable="true">Permiso</th>
      <th data-sortable="true">Privilegio</th>
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
								$iRegistryId = $userPermission->id_usr_per;
						?>
						@include('templates.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $userPermissions->render() !!}
@endsection
