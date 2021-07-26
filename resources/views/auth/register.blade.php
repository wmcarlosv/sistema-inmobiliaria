@extends('layout')

@section('content')
<div class="container auth">
    <div class="col-md-12">
         @include('partials.error_messages')
        <div class="card">
            <div class="card-header">
                <h3>Registro de Usuarios</h3>
            </div>
            <form method="POST" action="{{ route('register') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nombre:</label>
                        <input type="text" class="form-control" name="name" />
                    </div>
                    <div class="form-group">
                        <label for="">Contrasena:</label>
                        <input type="password" class="form-control" name="password" />
                    </div>
                    <div class="form-group">
                        <label for="">Confirmar Contrasena:</label>
                        <input type="password" class="form-control" name="password_confirmation" />
                    </div>
                    <div class="form-group">
                        <label for="">Telefono:</label>
                        <input type="text" class="form-control" name="phone" />
                    </div>

                    <div class="form-group">
                        <label for="">Correo Electronico:</label>
                        <input type="text" class="form-control" name="email" />
                    </div>

                    <div class="form-group">
                        <label for="">Ciudad:</label>
                        <select name="city_id" id="" class="form-control">
                            <option value="">Seleccione</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Foto:</label>
                        <input type="file" class="form-control" name="photo" />
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-success">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
