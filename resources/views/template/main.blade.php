<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>@yield('title')</title>
        {{-- Librerias CSS --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/paper/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/css/redbpi.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/trumbowyg.min.css')}}">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body>

@yield('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<script src="{{asset('public/js/animatescroll.min.js')}}"></script>
<script src="{{asset('public/js/trumbowyg.min.js')}}"></script>

<!-- Script No permitir usar la barra espaciadora en el momento de realizar el registro de usuario al
         campo(nom_usuario)-->
<script>
    $('#myInput').on('keydown', function (e) {
        if (e.keyCode == 32) {
            return false;
        }
    });
</script>

<script>
    capa = $("#tiempoEspera");
    capa.slideUp(1000);
    capa.delay(1500);
    capa.slideDown(1000);
</script>

<script>
    $('#showModal').modal({
        backdrop: 'static', show: true
    })
</script>


@yield('js')
</body>

</html>