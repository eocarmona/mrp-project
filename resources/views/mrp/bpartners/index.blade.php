@extends('front.mainListado')

@section('menu')
	@include('front.templates.menumodules')
@endsection

@section('title', trans('userinterface.titles.LIST_BPS'))

@section('content')
	<?php $sRoute="mrp.bpartners"?>
	@section('create')
		@include('front.templates.create')
	@endsection
	<table data-toggle="table" class="table table-striped">
		<thead>
			<th>{{ trans('userinterface.labels.BP') }}</th>
			<th>{{ trans('userinterface.labels.LAST_NAME') }}</th>
			<th>{{ trans('userinterface.labels.NAME') }}</th>
			<th>{{ trans('userinterface.labels.RFC') }}</th>
			<th>{{ trans('userinterface.labels.CURP') }}</th>
			<th>{{ trans('userinterface.labels.SIIE_ID') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
			<th>{{ trans('userinterface.labels.CREATED_BY') }}</th>
			<th>{{ trans('userinterface.labels.CREATED') }}</th>
			<th>{{ trans('userinterface.labels.UPDATED_BY') }}</th>
			<th>{{ trans('userinterface.labels.UPDATED') }}</th>
		</thead>
		<tbody>
			@foreach($bpartners as $bpartner)
				<tr>
					<td>{{ $bpartner->bp_name }}</td>
					<td>{{ $bpartner->last_name }}</td>
					<td>{{ $bpartner->first_name }}</td>
					<td>{{ $bpartner->id_fiscal }}</td>
					<td>{{ $bpartner->curp }}</td>
					<td>{{ $bpartner->siie_id }}</td>
					<td>
						@if (! $bpartner->is_deleted)
								<span class="label label-success">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $bpartner;
								$sRoute = 'mrp.bpartners';
								$iRegistryId = $bpartner->id_bp;
						?>
						@include('front.listed.options')
					</td>
					<td>
						@include('front.listed.createdUs')
					</td>
					<td>
						@include('front.listed.created')
					</td>
					<td>
						@include('front.listed.updatedUs')
					</td>
					<td>
						@include('front.listed.updated')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $bpartners->render() !!}
@endsection
