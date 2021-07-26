@extends('layout')
@section('title','Listado de Rentas')
@section('content')
	<div class="container auth">
		<div class="card">
			<div class="card-header">
				<h3>Listado de Rentas</h3>
			</div>
			<div class="card-body">
				<a href="{{ route('rents.create') }}" class="btn btn-success">Subir una Renta</a>
				<br />
				<br />
				<table class="table table-bordered table-striped data-table">
					<thead>
						<th>Depisito</th>
						<th>Precio al Mes</th>
						<th>Habitaciones</th>
						<th>Ubicacion</th>
						<th>Ciudad</th>
						<th>Colonia</th>
						<th>/</th>
					</thead>
					<tbody>
						@foreach($rents as $rent)
							<tr>
								<td>
									@if($rent->is_deposit)
										Si
									@else
										No
									@endif
								</td>
								<td>{{ $rent->price_to_month }}</td>
								<td>{{ $rent->bed_rooms }}</td>
								<td>{{ $rent->location }}</td>
								<td>{{ $rent->city->name }}</td>
								<td>{{ $rent->colony }}</td>
								<td>
									<a href="{{ route('rents.edit',$rent->id) }}" class="btn btn-info">Editar</a>
									<form style="display:inline;" method="POST" class="form-delete" action="{{ route('rents.destroy',$rent->id) }}">
										@csrf
										@method('DELETE')
										<button class="btn btn-danger">Borrar</button>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop
@section('js')
	@include('partials.messages')
@stop