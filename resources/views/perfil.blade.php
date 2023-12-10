@include('navbar')
@extends('layouts.app')

@section('content')
    <div class="cont">
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
                <label for="password">Contraseña:</label>
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