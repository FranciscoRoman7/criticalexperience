@include('navbar')
@extends('layouts.app')

@section('content')
<div class="container" id="tabla">
    
    <hr>
    <h1>Lista de Campañas</h1>
    <hr>
    
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
        <i class="fas fa-plus"></i>
    </button>
    
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ambientación</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($campaigns as $campaign)
                <tr>
                    <td>{{ $campaign->id }}</td>
                    <td>{{ $campaign->nombre }}</td>
                    <td>{{ $campaign->ambientacion }}</td>
                    <td>{{ $campaign->descripcion }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $campaign->id }}">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $campaign->id }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modales de Confirmación de Eliminación -->
@foreach ($campaigns as $campaign)
    <div class="modal fade" id="confirmDeleteModal{{ $campaign->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{ $campaign->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar la campaña "{{ $campaign->nombre }}"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Modal de Creación de Campaña -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Crear Campaña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('campaigns.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre *</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="ambientacion">Ambientación *</label>
                        <input type="text" class="form-control" name="ambientacion" id="ambientacion" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción *</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modales de Edición (uno por cada campaña) -->
@foreach ($campaigns as $campaign)
    <div class="modal fade" id="editModal{{ $campaign->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $campaign->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $campaign->id }}">Editar Campaña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('campaigns.update', $campaign->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nombre">Nombre *</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $campaign->nombre }}" required>
                        </div>
                        <div class="form-group">
                            <label for="ambientacion">Ambientación *</label>
                            <input type="text" class="form-control" name="ambientacion" id="ambientacion" value="{{ $campaign->ambientacion }}" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción *</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required>{{ $campaign->descripcion }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection