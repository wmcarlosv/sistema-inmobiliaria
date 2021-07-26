@extends('layout')
@section('title','Subir una Renta')
@section('content')
<div class="container auth">
	@include('partials.error_messages')
	<div class="card">
		<div class="card-header">
			<h3>Subir Nueva Renta</h3>
		</div>
		@if($type == 'new')
		<form action="{{ route('rents.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
			@csrf
			@method('POST')
		@else
		<form action="{{ route('rents.update',$rent->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
			@csrf
			@method('PUT')
		@endif
			<div class="card-body">
				<nav>
				  <div class="nav nav-tabs" id="nav-tab" role="tablist">
				    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#info" role="tab" aria-controls="nav-home" aria-selected="true">Informacion</a>
				    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="nav-profile" aria-selected="false">Fotos</a>
				  </div>

				</nav>
				<div class="tab-content" id="nav-tabContent">
				  <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="nav-home-tab">
				  	<div class="form-check" style="padding:20px 20px">
					  <label class="form-check-label">
					    <input type="checkbox" class="form-check-input" @if(@$rent->is_deposit) checked='checked' @endif name="is_deposit"> Deposito
					  </label>
					</div>

				  	<div class="form-group">
					   <label for="">Precio al Mes:</label>
					   <input type="text" name="price_to_month" value="{{ @$rent->price_to_month }}" class="form-control">
				    </div>
				    <div class="form-group">
					  <label for="">Numero de Habitaciones:</label>
					   <input type="text" name="bedrooms" value="{{ @$rent->bed_rooms }}" class="form-control">
				    </div>

				    <div class="form-group">
					  <label for="">Descripcion:</label>
					   <textarea name="description" class="form-control">{{ @$rent->description }}</textarea>
				    </div>

				    <div class="form-group">
					  <label for="">Ubicacion:</label>
					   <input type="text" name="location" value="{{ @$rent->location }}" class="form-control">
				    </div>

				    <div class="form-group">
					  <label for="">Ciudad:</label>
					   <select name="city_id" id="" class="form-control">
					   	<option value="">Seleccione</option>
					   	@foreach($cities as $city)
					   		<option value="{{ $city->id }}" @if(@$rent->city_id == $city->id) selected='selected' @endif>{{ $city->name }}</option>
					   	@endforeach
					   </select>
				    </div>

				    <div class="form-group">
					  <label for="">Colonia:</label>
					   <input type="text" name="colony" class="form-control" value="{{ @$rent->colony }}" />
				    </div>
				  </div>
				  <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="nav-profile-tab">
				  	<a href="#" id="add-photo" class="btn btn-success">+ Agregar Foto</a>
				  	<br />
				  	<br />
				  	<table class="table table-bordered table-striped">
				  		<thead>
				  			<th>Fotos</th>
				  		</thead>
				  		<tbody id="load-photos">
				  			@if($type == 'edit')
				  				@foreach($rent->RentPhotos as $photo)
				  					<tr>
				  						<td colspan="2">
				  							<div>
					  							<img class="img-thumbnail" style="width: 150px; height:150px; margin:10px 0px;" src="{{ asset('storage/rents') .'/'.$photo->url }}" alt="">
					  							<button class="btn btn-danger delete-imagen" type="button" data-url="{{ route('deleteImageRent',['id'=>$photo->id]) }}">Eliminar Imagen</button>
				  							</div>
				  						</td>
				  					</tr>
				  				@endforeach
				  			@endif
				  		</tbody>
				  	</table>
				  </div>
				</div>
		    </div>
		    <div class="card-footer text-right">
		    	<button class="btn btn-success">Guardar</button>
		    	<a href="{{ route('rents.index') }}" class="btn btn-danger">Cancelar</a>
		    </div>
		</form>
	</div>
</div>
@stop

@section('js')
<script>
	$(document).ready(function(){
		$(".delete-imagen").click(function(){
			let url = $(this).attr("data-url");
			var boton = $(this);

			$.get(url, function(response){
				let data = response;
				if(data.success == 'yes'){
					alert("Imagen eliminada con Exito!!");
					let div = boton.parent();
					let td = div.parent();
					div.parent().remove();
				}else{
					alert("No se pudo eliminar la imagen!!");
				}
			});
		});

		$("#add-photo").click(function(){
			$("#load-photos").append('<tr><td><input type="file" name="photos[]" class="form-control" /></td><td><button type="button" class="btn btn-danger delete-row">X</button></td></tr>');
		});

		$("body").on('click','button.delete-row', function(){
			$(this).parent().parent().remove();
		});
	});
</script>
@stop