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
        .valuecol{
            padding-left: 10%;
        }
    </style>

</head>
<body>
<div>
    <h1>Lista de Notas fiscais</h1>
    <form method="POST" action="/nfes/list">
        {{ csrf_field() }}
        <input name="text" type="text">
        <button type="submit">Buscar NFe</button>
    </form>
    <br><br>
<hr>
    <table>
        @if($nfes != '' && $nfes != '[]')
            <tr>
                <th>Chave de acesso</th>
                <th class="valuecol">Valor</th>
            </tr>
            @foreach($nfes as $nfe)
                <tr>
                    <td>{{ $nfe->access_key }}</td>
                    <td class="valuecol"> {{ $nfe->total }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>Nenhuma Nota fiscal encontrada para essa chave de acesso</td>
            </tr>
        @endif
    </table>
</div>
</body>
</html>
