@extends('front.mainListado')

@section('title', 'Lista de Empresas')

@section('content')
	<?php $ruta="companies/create"?>
	<table data-sortable="true" class="table table-striped">
		<thead>
			<th>Nombre Empreasa</th>
			<th>RFC</th>
			<th>Nombre Base de Datos</th>
			<th>Accion</th>
		</thead>
		<tbody>
			@foreach($companies as $company)
				<tr>
					<td>{{ $company->name }}</td>
					<td>{{ $company->rfc }}</td>
					<td>
						<a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"> </span></a>
						<a href="{{ route('companies.destroy', $company->id) }}" onclick="return confirm('¿Seguro que deseas eliminarlo?');" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $company->render() !!}
@endsection
