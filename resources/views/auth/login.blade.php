@extends('layout')

@section('content')
<div class="container auth">
    <div class="col-md-12">
        @include('partials.error_messages')
        <div class="card card-info">
            <div class="card-header">
                <h3>Iniciar Sesion</h3>
            </div>
            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="text" class="form-control" name="email" />
                    </div>
                    <div class="form-group">
                        <label for="">Password:</label>
                        <input type="password" class="form-control" name="password" />
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button style="float: left;" class="btn btn-info" onclick="javascript:location.href='{{ route('password.request') }}'" type="button">Recuperar Contrasena</button>
                    <button class="btn btn-info">Ingresar</button>
                    <button class="btn btn-success" onclick="javascript:location.href='{{ route('register') }}'" type="button">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
