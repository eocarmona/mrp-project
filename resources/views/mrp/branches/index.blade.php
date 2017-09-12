@extends('front.mainListado')

@section('menu')
	@include('front.templates.menumodules')
@endsection

@section('title', trans('userinterface.titles.LIST_BRANCHES'))

@section('content')
	<?php $sRoute="mrp.branches"?>
	@section('create')
		@include('front.templates.create')
	@endsection
	<table data-toggle="table" class="table table-striped">
		<thead>
			<th>{{ trans('userinterface.labels.CODE') }}</th>
			<th>{{ trans('userinterface.labels.NAME') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
		</thead>
		<tbody>
			@foreach($branches as $branch)
				<tr>
					<td>{{ $branch->code }}</td>
					<td>{{ $branch->name }}</td>
					<td>
						@if (! $branch->is_deleted)
								<span class="label label-success">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $branch;
								$sRoute = 'mrp.branches';
								$iRegistryId = $branch->id_branch;
						?>
						@include('templates.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $branches->render() !!}
@endsection
