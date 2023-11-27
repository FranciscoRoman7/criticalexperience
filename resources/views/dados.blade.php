@include('navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tirador de Dados de Rol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>

        #container {
            padding: 10%;
        }

        body {
            
            background-color: #f8f9fa;
            margin: 0;
        }


        header {
            text-align: center;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .img {

            width: 100px;
            height: 100px;

        }

        .controls-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .history {
            max-width: 90%;
            width: 100%;
            margin:50px;
        }

        .history-list {
            list-style-type: none;
            padding: 0;
            overflow-y: auto;
            max-height: 200px;
            border: 1px solid #dee2e6;
            padding: 10px;
            font-size: 14px;
            text-align:center;
            margin: 0;
        }

        .clear-history {
            margin-top: 10px;
            margin-left:45px;
        }

        .counter-buttons {
            display: flex;
            justify-content: center;
            margin-bottom:0%;
        }

        .counter-buttons button {
            margin: 0 10px;
        }

        .dice-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            background-color:#fff;
            gap: 5px;
        }

        .dice {
            text-align: center;
            margin: 10px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            
            flex: 0 0 calc(10% - 10px);
            max-width: calc(100% - 10px);
        }

        @media (max-width: 767px) {

            #container{
                padding-left:20%;
                
            }

            .controls-container {
               
                display: flex;
                flex-direction: column;
                align-items: center;
                position:fixed;
            }

            .dice-container {
                order: 2;
                flex-direction: row;
                position:fixed;
                bottom:0px;

            }

            .dice {
                max-width: calc(100%);
            }

            .mobile-controls {
                order: 1;
                position: sticky;
                background-color: #fff;
                z-index: 1000;
                padding: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                margin-bottom:0%;
            }

            .history{
                top:5%;
                margin:40px;
                margin-bottom:200px;
            }

            .history-list {
                font-size: 12px;
                max-height: 150px;
            }

            .counter-buttons {
                display: flex;
            }
        }

    </style>
</head>
<body>
    
    <div id="container">
        <hr>
        <h1>Ventana de dados</h1>
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
                        @foreach($tiradas as $tirada)
                            <li>
                                D{{ $tirada->tipo_dado }}-Tirada: {{$tirada->resultado}} + Bonificador: {{ $tirada->bonificador }} = Resultado: {{ $tirada->total }}
                            </li>
                        @endforeach
                    </ul>
                    <button class="btn btn-danger clear-history">Borrar Historial</button>
                </div>
            </div>
        </main>
    </div>
    <script src="./js/dados.js"></script>
</body>
</html>