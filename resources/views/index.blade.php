<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Desafio Arquivei</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 10px;
        }

        .links > a {
            color: #636b6f;
            padding: 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .errormsg{
            color: red;
            font-family: 'Nunito', sans-serif;
            font-weight: bold;
        }
        .successmsg{
            color: blue;
            font-family: 'Nunito', sans-serif;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div>
    <h1>Notas Fiscais</h1>
    <p class="errormsg">{{ $message ?? '' }}</p>
    <p class="successmsg">{{ $success_message ?? '' }}</p>
    <form method="POST" action="/nfes">
        {{ csrf_field() }}
        <button type="submit">Importar dados da API</button>
    </form>
    <br>
    <form method="POST" action="/nfes/list">
        {{ csrf_field() }}
        <button type="submit">Listar Notas Fiscais</button>
    </form>
</div>
</body>
</html>
