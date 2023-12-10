<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Agrega FontAwesome para los iconos -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>

        #top-bar {
            background-color: #0e3b74;
            color: #fff;
            margin: 0%;
            padding: 3px;
            text-align: left;
            position: fixed;
            width: 100%;
            z-index: 999;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .brand-name {
            font-family: 'Arial', sans-serif;
            font-size: 24px;
            margin-left: 10px;
            color: white;
        }

        #logo {
            width: 50px;
            height: 70px;
            margin-right: 10px;
            padding-left:10px
        }

        #sidebar-wrapper {
            height: 100%;
            width: 80px;
            position: fixed;
            top: 50px;
            left: -80px;
            z-index: 998;

            background-color: #1a1a1a;
            transition: all 0.5s;
        }

        #sidebar-wrapper a {
            padding: 15px 10px;
            text-decoration: none;
            font-size: 24px;
            color: #fff;
            display: block;
            transition: 0.2s;
            text-align: center;
        }

        #sidebar-wrapper a:hover {
            background-color: #004d82;
        }

        #sidebar-wrapper.toggled {
            left: 0;
        }

        #menu-toggle {
            position: fixed;
            top: 80px;
            left: 10px;
            z-index: 1;
            color: #0e3b74;
            background-color: transparent;
            border: none;
            outline: none;
            font-size: 30px;
            cursor: pointer;
            transition: 0.5s;
        }

        @media (max-width: 768px) {
            #menu-toggle {
                display: none;
            }

            #sidebar-wrapper {
                left: 0;
            }
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .user-info p {
            margin-bottom: 0;
            margin-right: 10px;
            font-size: 16px;
            color: white;
        }

        .user-info a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .user-info a:hover {
            color: #ffc107;
        }

        .user-info a .profile-icon {
            margin-right: 5px;
            font-size: 18px;
        }
    </style>
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

    <script>
        document.getElementById("menu-toggle").addEventListener("click", function () {
            document.getElementById("sidebar-wrapper").classList.toggle("toggled");

            const menuToggle = document.getElementById("menu-toggle");
            if (document.getElementById("sidebar-wrapper").classList.contains("toggled")) {
                menuToggle.style.left = "90px";
            } else {
                menuToggle.style.left = "20px";
            }
        });
    </script>
    
</body>

</html>