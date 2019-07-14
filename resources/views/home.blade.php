<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- importando css compilado--}}
        <link rel="stylesheet" href="css/app.css">

        <title>Registro de alimentos</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        
    </head>
    <body>
        <div id="app"> 


            {{-- usamos yield para mostrar contenido --}}
            @yield('content-body')
           
         
        </div>
        <script src="js/app.js"></script>
        <script src="js/plantilla.js"></script>
    </body>
</html>
