<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./css/registro.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">

</head>
<body> 
    <!-- TITULO -->
    <h1>CRITICAL EXPERIENCE</h1>
    <div class="info">
        <a href="" target="_blank">
            <p>Por <i class="fa fa-heart"></i> Fco Román Peña González</p>
        </a>
    </div>

    <div class="content">
        <div class="container">
          <img class="bg-img" src="./images/f.png" alt="">
            
            <!-- ENCABEZADOS -->
            <div class="menu">
                <a  class="btn-enregistrer active"><h2>REGISTRARSE</h2></a>
                <a  class="btn-connexion" autocomplete="current-password"><h2>LOGIN</h2></a>
            </div>

            <!-- LOGIN -->
            <div class="connexion">
                <div class="contact-form">
                    <!-- FORMULARIO LOGIN -->
                    <form id="login-form" action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <label>Email</label>
                        <input placeholder="" name="email" type="text" id="login-username">
                        @error('email')
                            <label id="error-log" style="color: red" class="login-error">{{$message}}</label>
                        @enderror

                        <label>Contraseña</label>
                        <input placeholder="" name="password" type="password" id="login-password" autocomplete="new-password">
                        @error('password')
                            <label id="error-log"  style="color: red" class="login-error">{{$message}}</label>
                        @enderror

                        <br>
                        <input id="bt-log"  class="submit" value="SIGN IN" type="submit">

                        @if(session('login_error'))
                            <div class="alert alert-success">
                                <label style="color: red" class="login-error">{{ session('login_error') }}</label>
                            </div>
                        @endif
                    </form>
                </div>
                <hr>
            </div>
            
            <!-- REGISTRO -->
            <div class="enregistrer active-section">
                <!-- FORMULARIO DE REGISTRO -->
                <form id="register-form" action="{{ route('registro') }}" method="POST">
                    @csrf
                    <label>Nombre</label>
                    <input placeholder="" type="text" name="name" value="{{old('name')}}" id="register-username">
                    @error('name')
                        <label id="error-regis" style="color: red" class="registration-error">{{$message}}</label>
                    @enderror

                    <label>Email</label>
                    <input placeholder="" type="email" name="email" value="{{old('email')}}" id="register-email">    
                    @error('email')
                        <label id="error-regis" style="color: red" class="registration-error">{{$message}}</label>
                    @enderror

                    <label>Contraseña</label>
                    <input placeholder="" type="password" name="password" id="register-password">
                    @error('password')
                        <label id="error-regis" style="color: red" class="registration-error">{{$message}}</label>
                    @enderror

                    <label>Confirmar Contraseña</label>
                    <input placeholder="" type="password" name="password_confirmation" id="register-confirm-password">
                    <br>
                    <input id="bt-regis" class="submit" value="REGISTRAR" type="submit">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <label style="color: #b4ff9a" class="registration-error">{{ session('success') }}</label>
                        </div>
                    @endif
                    @if(session('registration_error'))
                        <div class="alert alert-success">
                            <label style="color: red" class="registration-error">{{ session('registration_error') }}</label>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- JQUERY Y REFERENCIAS A ARCHIVOS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/registro.js"></script>
</body>
</html>