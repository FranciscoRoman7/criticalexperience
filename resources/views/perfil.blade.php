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
                    <div class="invalid-feedback" style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="codigopostal">Código Postal:</label>
                <input type="text" name="codigopostal" id="codigopostal" class="form-control" value="{{ old('codigopostal', $users->codigopostal) }}">
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion', $users->direccion) }}">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $users->telefono) }}">
            </div>

            <div class="form-group">
                <label for="password">Nueva Contraseña:</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" minlength="8">
                @error('password')
                    <div class="invalid-feedback" style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

            @if(session('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection