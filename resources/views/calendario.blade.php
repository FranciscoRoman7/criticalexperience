@include('navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        #container {
            padding:10%;
        }

        @media (max-width: 768px) {
          #container {
            padding:8%;
            padding-top:20%;
            padding-left:15%;
        } 
        }
        
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/locales-all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Calendario</title>
</head>
<body>
    




<div id="container">
  <hr>
  <h1>Calendario de eventos</h1>
  <hr>
  <div id="calendario">
  </div>
  <div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Crear Evento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="">
            @csrf

            <div class="form-group">
              <label for="title">Nombre</label>
              <input type="text" class="form-control" name="title" id="title" required>
            </div>

            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="10" required></textarea>

            </div>
            <div class="form-group">
              <label for="start">Fecha de inicio</label>
              <input type="date" class="form-control" name="start" id="start" required>
            </div>

            <div class="form-group">
              <label for="end">Fecha de finalización</label>
              <input type="date" class="form-control" name="end" id="end" required>
            </div>

          </form>
        </div>
        @error('error')
        <label id="error" style="color: red" class="login-error">{{$message}}</label>
        @enderror
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="btguardar">Guardar</button>
          <button type="button" class="btn btn-warning" id="btmodificar">Modificar</button>
          <button type="button" class="btn btn-danger" id="bteliminar">Eliminar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>            
        </div>
      </div>
    </div>
  </div>
  <hr>
</div>

<div class="modal fade" id="confirmacionEliminar" tabindex="-1" role="dialog" aria-labelledby="confirmacionEliminarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmacionEliminarLabel">Confirmar Eliminación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Está seguro de que desea eliminar este registro?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id= "confirmarEliminar"class="btn btn-danger" id="bteliminar">Eliminar</button>
      </div>
    </div>
  </div>
</div>


</body>
<script src="./js/agenda.js"></script>
</html>