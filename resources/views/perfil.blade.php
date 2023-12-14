@include('navbar')
@extends('layouts.app')

@section('content')
    <div id="perfil">
        <hr>
        <h1>Perfil de Usuario</h1>
        <hr>

        <form action="{{ route('perfil.update') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $users->name) }}" required>
            @error('name')
                <span class="invalid-feedback" role="alert" style="color: red;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="codigopostal">Código Postal:</label>
            <input type="text" name="codigopostal" id="codigopostal" class="form-control @error('codigopostal') is-invalid @enderror" value="{{ old('codigopostal', $users->codigopostal) }}">
            @error('codigopostal')
                <span class="invalid-feedback" role="alert" style="color: red;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion', $users->direccion) }}">
            @error('direccion')
                <span class="invalid-feedback" role="alert" style="color: red;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $users->telefono) }}">
            @error('telefono')
                <span class="invalid-feedback" role="alert" style="color: red;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        @if(session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

        <button type="button" class="btn btn-info mt-4" data-toggle="modal" data-target="#changePasswordModal">Cambiar Contraseña</button>

        
        <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Cambiar Contraseña</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    <form action="{{ route('perfil.changePassword') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="current_password">Contraseña Actual:</label>
                            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert" style="color: red;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password">Nueva Contraseña:</label>
                            <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" required minlength="8">
                            @error('new_password')
                                <span class="invalid-feedback" role="alert" style="color: red;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation">Confirmar Nueva Contraseña:</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger mt-3" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                    </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection