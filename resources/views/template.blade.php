<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('titulo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!--  BootStrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <style>
        th, td {
            text-align: center;
        }
    </style>

</head>

<body>
    <div class="row">
        <div class="col-3">
            <ul class="list-group">
                <li class="list-group-item active" style="text-align: center">Menu</li>
                <li class="list-group-item"><a href="/professores"><i class="fas fa-chalkboard-teacher"></i> Professores</a></li>
                <li class="list-group-item"><i class="fas fa-door-closed"></i> Salas</li>
                <li class="list-group-item"><i class="fas fa-book"></i> Reservas</li>
            </ul>
        </div>
        <div class="col-8">
            @yield('meio')
        </div>
    </div>

</body>

@yield('scripts')

</html>
