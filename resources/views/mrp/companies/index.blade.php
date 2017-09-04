@extends('front.mainListado')

@section('title', trans('userinterface.titles.LIST_COMPANIES'))

@section('content')
	<?php $ruta="companies"?>
	<table data-toggle="table" class="table table-striped">
		<thead>
			<th>{{ trans('userinterface.labels.COMPANY') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
		</thead>
		<tbody>
			@foreach($companies as $company)
				<tr>
					<td>{{ $company->name }}</td>
					<td>
						<?php
								$oRegistry = $company;
								$sRoute = 'mrp.companies';
								$iRegistryId = $company->id_company;
						?>
						@include('templates.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $companies->render() !!}
@endsection
