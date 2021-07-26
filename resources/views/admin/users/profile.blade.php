@extends('layout')

@section('title','Perfil')

@section('content')
	<div class="container auth">
		@include('partials.error_messages')
		<div class="card">
			<div class="card-header">
				<h3>Perfil</h3>
			</div>
			<form method="POST" action="{{ route('update_profile') }}" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="card-body">
					<div class="form-group">
						<label for="">Nombre:</label>
						<input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" >
					</div>
					<div class="form-group">
						<label for="">Telefono:</label>
						<input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control">
					</div>
					<div class="form-group">
						<label for="">Ciudad:</label>
						<select name="city_id" id="" class="form-control">
							<option value="">Seleccione</option>
							@foreach($cities as $city)
								<option value="{{ $city->id }}" @if($city->id == Auth::user()->city_id) selected='selected' @endif>{{ $city->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="">Foto:</label>
						@if(Auth::user()->photo)
							<div style="padding: 10px 0px 20px 0px;">
								<img class="img-thumbnail" style="width: 300px; height: 300px;" src="{{ asset('storage/profile/'.Auth::user()->photo) }}" alt="Profile" />
							</div>
						@endif
						<input type="file" name="photo" class="form-control">
					</div>
				</div>
				<div class="card-footer text-right">
					<button class="btn btn-success">Actualizar Perfil</button>
				</div>
			</form>
		</div>
		<br />
		<div class="card">
			<div class="card-header">
				<h3>Clave</h3>
			</div>
			<form method="POST"  action="{{ route('update_password') }}">
				@csrf
				@method('PUT')
				<div class="card-body">
					<div class="form-group">
						<label for="">Contrasena:</label>
						<input type="password" name="password" class="form-control" />
					</div>
					<div class="form-group">
						<label for="">Confirma Contrasena:</label>
						<input type="password" name="password_confirmation" class="form-control" />
					</div>
				</div>
				<div class="card-footer text-right">
					<button class="btn btn-success">Actualizar Clave</button>
				</div>
			</form>
		</div>
	</div>
@stop

@section('js')
	@include('partials.messages')
@stop