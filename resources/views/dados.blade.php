@include('navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tirador de Dados de Rol</title>
    <link rel="stylesheet" href=".\css\dados.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    
    <div id="container">
        <hr>
        <h1 align="center">Ventana de dados</h1>
        <hr>

        <main>
            <div class="controls-container">
                <div class="mobile-controls">
                    <div class="counter-buttons">
                        <h2>Bonificador</h2>
                        <br>
                        <button class="btn btn-secondary inc-counter" id="incrementBtn">+</button>
                        <span class="counter-value" id="counterValue">0</span>
                        <button class="btn btn-secondary dec-counter" id="decrementBtn">-</button>
                    </div>
                </div>

                <div class="dice-container">
                    <div class="dice">
                        <img class="img" src="./images/D4.PNG" alt="">
                        <button class="btn btn-primary roll-die" data-sides="4">Tirar D4</button>
                    </div>
                    <div class="dice">
                    <img class="img" src="./images/D6.PNG" alt="">
                        <button class="btn btn-primary roll-die" data-sides="6">Tirar D6</button>
                    </div>
                    <div class="dice">
                    <img class="img" src="./images/D8.PNG" alt="">
                        <button class="btn btn-primary roll-die" data-sides="8">Tirar D8</button>
                    </div>
                    <div class="dice">
                    <img class="img" src="./images/D10.PNG" alt="">
                        <button class="btn btn-primary roll-die" data-sides="10">Tirar D10</button>
                    </div>
                    <div class="dice">
                    <img class="img" src="./images/D12.PNG" alt="">
                        <button class="btn btn-primary roll-die" data-sides="12">Tirar D12</button>
                    </div>
                    <div class="dice">
                    <img class="img" src="./images/D20.PNG" alt="">
                        <button class="btn btn-primary roll-die" data-sides="20">Tirar D20</button>
                    </div>
                    <div class="dice">
                    <img class="img" src="./images/D90.PNG" alt="">
                        <button class="btn btn-primary roll-die" data-sides="90">Tirar D90</button>
                    </div>
                </div>

                <div class="history">
                    <h2 align="center">Historial de Tiradas</h2>
                    <ul class="history-list">
                        @php
                            $totalSum = 0; // Variable para almacenar la sumatoria de resultados
                        @endphp
                        @foreach($tiradas->reverse() as $tirada)
                            @php
                                $totalSum += $tirada->total; // Sumar al total
                            @endphp
                            <li>
                                D{{ $tirada->tipo_dado }}-Tirada: {{$tirada->resultado}} + Bonificador: {{ $tirada->bonificador }} = Resultado: {{ $tirada->total }}
                            </li>
                        @endforeach
                    </ul>
                    <p align="center">Total de resultados: {{ $totalSum }}</p>
                    <button class="btn btn-danger clear-history">Borrar Historial</button>
                </div>
            </div>
        </main>
    </div>
    <script src="./js/dados.js"></script>
</body>
</html>