<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>@yield('title')</title>
        {{-- Librerias CSS --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/paper/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/redbpi.css')}}">
    <link rel="stylesheet" href="{{asset('css/trumbowyg.min.css')}}">

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

@yield('search')

@yield('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<script src="{{asset('js/animatescroll.min.js')}}"></script>
<script src="{{asset('js/trumbowyg.min.js')}}"></script>

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

<script type="text/javascript">
    jQuery(function ($) {
        $('.panel-heading span.clickable').on("click", function (e) {
            if ($(this).hasClass('panel-collapsed')) {
                // expand the panel
                $(this).parents('.panel').find('.panel-body').slideDown();
                $(this).removeClass('panel-collapsed');
                $(this).find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
            }
            else {
                // collapse the panel
                $(this).parents('.panel').find('.panel-body').slideUp();
                $(this).addClass('panel-collapsed');
                $(this).find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#onlynumbers").keydown(function (event) {
            if (event.shiftKey) {
                event.preventDefault();
            }
            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {
            }
            else {
                if (event.keyCode < 95) {
                    if (event.keyCode < 48 || event.keyCode > 57) {
                        event.preventDefault();
                    }
                }
                else {
                    if (event.keyCode < 96 || event.keyCode > 105) {
                        event.preventDefault();
                    }
                }
            }
        });
    });
</script>

<script>
    $(document).ready(function()
    {
        $("#select_programa").change(function()
        {
            if($(this).val() == 1)
            {
                $("#valuePrograma").show();
                $("#valueProgramaedit").show();
            }
            else
            {
                $("#valuePrograma").hide();
                $("#valueProgramaedit").hide();
            }
        });
        $("#valuePrograma").hide();
    });
</script>

<script>
    $(document).ready(function()
    {
        $("#select_programa").change(function()
        {
            if($(this).val() == 2)
            {
                $("#valuesubPrograma").show();
                $("#valuesubProgramaedit").show();
            }
            else
            {
                $("#valuesubPrograma").hide();
                $("#valuesubProgramaedit").hide();
            }
        });
        $("#valuesubPrograma").hide();
    });
</script>

@yield('js')

</body>

</html>