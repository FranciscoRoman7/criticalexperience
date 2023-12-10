@include('navbar')
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Roles - Introducción</title>
    <!-- Agrega aquí tus enlaces a Bootstrap y FontAwesome si no los tienes ya -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

        body{
            overflow:hidden;
        }

        #content-container {
            padding: 6%;
        }

        .card {
            transition: box-shadow 0.3s ease-in-out;
            box-shadow: 0 0 0 rgba(0, 0, 0, 0);
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
   
        @media (max-width: 768px) {
            body{overflow:visible;}
            #content-container {
            padding-left: 15%;
        }
        }
       
    </style>
</head>

<body>
   
    <div id="content-container">
        <div id="page-content-wrapper">
            <div class="container mt-4">
                <hr>
                <h1 class="text-center">¡Bienvenido a Critical Experience!</h1>
                <hr>
                <p class="lead text-center mb-4">Esta aplicación de gestión de juegos de rol ofrece herramientas poderosas para administrar diferentes aspectos dentro de tu entorno.</p>
               
                <!-- Cards para cada apartado correspondiendo a los elementos del Navbar -->
                <div class="row">
                @if($isAdmin)
                    <div class="col-lg-4 col-md-6 mb-4" id="Usuarios">
                        <a href="users" style="color:black;">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-4x mb-3"></i>
                                <h4 class="card-title">Usuarios</h4>
                                <p class="card-text">Gestiona los usuarios de la aplicación.</p>
                            </div>
                        </div>
                        </a>
                    </div>
                @endif

                    <div class="col-lg-4 col-md-6 mb-4" id="Eventos">
                    <a href="calendario" style="color:black;">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-calendar-alt fa-4x mb-3"></i>
                                <h4 class="card-title">Calendario</h4>
                                <p class="card-text">¡Gestiona tus propios eventos!</p>
                            </div>
                        </div>
                    </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4" id="Campañas">
                    <a href="campaigns" style="color:black;">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-fire fa-4x mb-3"></i>
                                <h4 class="card-title">Campañas</h4>
                                <p class="card-text">¡Registra y gestiona las campañas en las que estes participando!</p>
                            </div>
                        </div>
                    </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4" id="Dados">
                    <a href="dados" style="color:black;">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-dice fa-4x mb-3"></i>
                                <h4 class="card-title">Dados</h4>
                                <p class="card-text"><strong>¿Se te han olvidado? ¡Tira los dados!</strong></p>
                                <p>En esta ventana puedes tirar dados y los datos se registrarán en tus historial de tiradas.</p>
                            </div>
                        </div>
                    </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4" id="Archivos">
                    <a href="files" style="color:black;">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-file fa-4x mb-3"></i>
                                <h4 class="card-title">Archivos</h4>
                                <p class="card-text"><strong>¡Sube y gestiona tus archivos!</strong></p>
                                <p>En esta ventana puedes subir y gestionar archivos relacionados con las campañas existentes.</p>
                            </div>
                        </div>
                    </a>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mb-4" id="Archivos">
                    <a href="perfil" style="color:black;">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-user fa-4x mb-3"></i>
                                <h4 class="card-title">Tu perfil</h4>
                                <p>¡En esta ventana puede visualizar tus datos y cambiar tu nombre o contraseña!</p>
                            </div>
                        </div>
                    </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Scripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>

</html>