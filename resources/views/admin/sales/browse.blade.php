@extends('layout')
@section('title','Listado de Ventas')
@section('content')
	<div class="container auth">
		<div class="card">
			<div class="card-header">
				<h3>Listado de Ventas</h3>
			</div>
			<div class="card-body">
				<a href="{{ route('sales.create') }}" class="btn btn-success">Subir una Venta</a>
				<br />
				<br />
				<table class="table table-bordered table-striped data-table">
					<thead>
						<th>Precio</th>
						<th>Habitaciones</th>
						<th>Ubicacion</th>
						<th>Ciudad</th>
						<th>/</th>
					</thead>
					<tbody>
						@foreach($sales as $sale)
							<tr>
								<td>{{ $sale->price }}</td>
								<td>{{ $sale->bed_rooms }}</td>
								<td>{{ $sale->location }}</td>
								<td>{{ $sale->city->name }}</td>
								<td>
									<a href="{{ route('sales.edit',$sale->id) }}" class="btn btn-info">Editar</a>
									<form style="display:inline;" method="POST" class="form-delete" action="{{ route('sales.destroy',$sale->id) }}">
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