@include('navbar')
@extends('layouts.app')

@section('content')
<div class="container my-4 pt-5 p-4">
    <h2>Gestión de Archivos</h2>

    <!-- Formulario para subir archivos -->
    <form action="{{ route('files.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="campaign_id">Selecciona una campaña:</label>
            <select name="campaign_id" id="campaign_id" class="form-control" required>
                <option value="">Ninguna</option><!---->
                @foreach($campaigns as $campaign)
                    <option value="{{ $campaign->id }}" {{ $selectedCampaign == $campaign->id ? 'selected' : '' }}>
                        {{ $campaign->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        @if($isAdmin)
        @endif
        <div class="form-group">
            <label for="file">Selecciona un archivo:</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="file" id="file" required>
                <label class="custom-file-label" for="file">Seleccionar archivo</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Subir archivo</button>
    </form>
    <br><br><br>

    <div class="form-group">
        <label for="search">Buscar por nombre:</label>
        <input type="text" id="search" class="form-control" placeholder="Escribe para filtrar por nombre">
    </div>
    

    <h3>Archivos subidos</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="file-table-body">
            @foreach($files as $file)
                <tr>
                    <td>{{ $file->name }}</td>
                    <td>
                        <a href="{{ route('files.show', $file->id) }}" class="btn btn-info">Mostrar</a>

                        <a href="{{ route('files.download', $file->id) }}" class="btn btn-success">Descargar</a>

                        <form action="{{ route('files.destroy', $file->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.getElementById('campaign_id').addEventListener('change', function() {
            var selectedCampaign = this.value;
            window.location.href = "{{ route('files.index') }}?campaign_id=" + selectedCampaign;
        });

        $(document).ready(function() {
        $('#search').on('input', function() {
            var searchText = $(this).val().toLowerCase();
            $('#file-table-body tr').each(function() {
                if (searchText === '') {
                    $(this).show();
                } else {
                    var fileName = $(this).find('td:first').text().toLowerCase();
                    $(this).toggle(fileName.includes(searchText));
                }
            });
        });
    });
    </script>

    <script>
        document.getElementById('file').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            var label = document.querySelector('.custom-file-label');
            label.textContent = fileName;
        });
    </script>
</div>
@endsection