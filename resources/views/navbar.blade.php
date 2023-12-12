<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Agrega FontAwesome para los iconos -->
    <link rel="stylesheet" href="./css/navbar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
<div id="top-bar" class="d-flex">
        <div class="logo-container">
            <img id="logo" src="./images/logo.png" alt="Logo">
            <span class="brand-name">Critical Experience</span>
        </div>

        <div class="ml-auto">
            <div class="user-info">
                <a href="perfil">{{$username}}<br><i class="fas fa-user profile-icon"></i></a>
            </div>
        </div>
    </div>

    <div class="d-flex">
        <button class="btn" id="menu-toggle">&#9776;</button>
        <nav id="sidebar-wrapper">
            <ul class="nav flex-column">
               <br><br>
                <li class="nav-item">
                    <a class="nav-link" href="home" title="Inicio"><i class="fas fa-home"></i></a>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="calendario" title="Calendario"><i class="fas fa-calendar-alt"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="campaigns" title="Campañas"><i class="fas fa-fire"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dados" title="Dados"><i class="fas fa-dice"></i></a>
                </li>
                @if($isAdmin)
                <li class="nav-item">
                    <a class="nav-link" href="users" title="Usuarios"><i class="fas fa-users"></i></a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="files" title="Archivos"><i class="fas fa-file"></i></a>
                </li>
                <div class="exit-icon" style="bottom:0%;">
                <a href="{{ route('logout') }}" class="text-danger">Salir <i class="fas fa-sign-out-alt"></i></a>
                </div>
            </ul>
        </nav>

        <div id="page-content-wrapper">
        </div>
    </div>

    <script src="./js/navbar.js"></script>
    
</body>

</html>