@include('navbar')
@extends('layouts.app')
@section('content')
    <hr>
    <h1>Lista de Usuarios</h1>
    <hr>

<div class="container" id = "tabla">


    <div class="form-group">
        <label for="filterEmail">Filtrar por correo electrónico (Email):</label>
        <input type="text" class="form-control" id="filterEmail">
    </div>

    <!-- Botón para abrir el modal de creación -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
    <i class="fas fa-plus"></i>
    </button>

    @if(session('error'))
        <div class="alert alert-success">
        <label id="register-error" style="color: red" class="error">{{ session('error') }}</label>
        </div>
    @endif
    
    <table class="table mt-3" id="usersTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Código Postal</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->codigopostal }}</td>
            <td>{{ $user->direccion }}</td>
            <td>{{ $user->telefono }}</td> 
                <td>
                    <!-- Botón para abrir el modal de edición -->
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{$user->id}}">
                    <i class="fas fa-pencil-alt"></i>
                    </button>
                    <!-- Botón para abrir el modal de confirmación de eliminación -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{$user->id}}">
                       <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal de Creación de Usuario -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Crear Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para crear un nuevo usuario -->
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    
                    <!-- Campo para el nombre del usuario -->
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <!-- Campo para el email del usuario -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>

                    <!-- Campo para el cpostal del usuario -->

                    <div class="form-group">
                        <label for="codigopostal">Código Postal</label>
                        <input type="text" class="form-control" name="codigopostal" id="codigopostal">
                    </div>

                    <!-- Campo para la direccion del usuario -->

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" name="direccion" id="direccion">
                    </div>
                    
                    <!-- Campo para la telfono del usuario -->

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono">
                    </div>
                    
                    <!-- Campo para la contraseña del usuario -->
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="admin" id="admin" value="1">
                        <label class="form-check-label" for="admin">Admin</label>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modales de Edición y Confirmación de Eliminación (uno para cada usuario) -->
@foreach ($users as $user)
<div class="modal fade" id="editModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{$user->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{$user->id}}">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para editar los datos del usuario -->
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="codigopostal">Código Postal</label>
                        <input type="text" class="form-control" name="codigopostal" id="codigopostal" value="{{ $user->codigopostal }}">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" value="{{ $user->direccion }}">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" value="{{ $user->telefono }}">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="admin" id="admin" value="1" {{ $user->admin ? 'checked' : '' }}>
                        <label class="form-check-label" for="admin">Admin</label>
                    </div>
                    <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmDeleteModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{$user->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Contenido del modal de confirmación de eliminación para el usuario actual -->
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar a {{$user->name}}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endforeach

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#filterEmail').keyup(function() {
            var filterValue = $(this).val().toLowerCase();

            // Ocultar todas las filas de la tabla
            $('#usersTable tbody tr').hide();

            // Mostrar solo las filas que coincidan con el correo electrónico filtrado
            $('#usersTable tbody tr').each(function() {
                var email = $(this).find('td:eq(2)').text().toLowerCase(); // Cambia el índice según la columna del correo electrónico
                if (email.includes(filterValue)) {
                    $(this).show();
                }
            });
        });
    });
</script>

@endsection