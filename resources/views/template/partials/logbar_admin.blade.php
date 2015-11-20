<nav class="navbar navbar-default " role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav nav-pills navbarlog">
                <li class="dropdown">
                    <a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Gestión General <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('departamento')}}">Departamentos</a></li>
                        <li><a href="{{route('municipio')}}">Municipios</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('cargoUsuario')}}">Cargos Laborales</a></li>
                        <li><a href="{{route('tipoIdentificacion')}}">Tipo de identificación</a></li>
                        <li><a href="{{route('tipoSecretaria')}}">Tipo de Secretaría</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Gestión De Notificaciones <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('biblioteca')}}">Biblioteca</a></li>
                        <li><a href="{{route('noticia')}}">Noticias</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Notificaciones E-mail</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Gestión De Usuarios <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('verificar_usuarios')}}">Verificar Usuarios</a></li>
                        <li><a href="{{route('verificar_roles')}}">Gestionar Roles</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Gestionar Permisos</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Funciones del Banco <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('plan_desarrollo')}}"> Plan de Desarrollo</a></li>
                   </ul>
                </li>

                <li class=" nav navbar-right dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                                class="fa fa-user"></i>  {{Auth::user()->user_login}} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{{ URL::to('/') }}}"><i class="fa fa-undo"></i> Regresar al Banco </a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Cerrar Sesión </a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>

</nav>