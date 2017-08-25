@extends('front.mainListado')

@section('title', trans('userinterface.titles.LIST_USERS'))

@section('content')
	<?php $ruta="users"?>
	<table data-toggle="table" class="table table-striped">
		<thead>
			<th data-sortable="true">{{ trans('userinterface.labels.NAME') }}</th>
			<th data-sortable="true">{{ trans('userinterface.labels.EMAIL') }}</th>
			<th data-sortable="true">{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{ $user->username }}</td>
					<td>{{ $user->email }}</td>
					<td>
						@if ($user->is_deleted == \Config::get('scsys.STATUS.ACTIVE'))
								<span class="label label-success">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $user;
								$sRoute = 'users';
								$iRegistryId = $user->id;
						?>
						@include('templates.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $users->render() !!}
@endsection
