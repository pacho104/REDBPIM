<link href="{{asset('css/bootstrap1.min.css')}}" rel="stylesheet">
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
                        <li class="divider"></li>
                        <li><a href="#">Roles</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Gestión De Comunicaciones
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Gestionar Biblioteca</a></li>
                        <li><a href="{{route('noticia')}}">Gestionar Noticias</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('salas.index')}}">Gestionar Sala de Chat</a></li>
                        <li><a href="../salasDis">Ingresar a Sala de Chat</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestionar Elementos Del Banco<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('estados.index')}}">Gestionar Estados</a></li>
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestionar Listas de Chequeo</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('proceso.index')}}">Gestionar Procesos</a></li>
                                <li><a href="{{route('recurso.index')}}">Gestionar Recurso</a></li>
                                <li><a href="{{route('etapaLista.index')}}">Gestionar Etapa</a></li>
                                <li><a href="{{route('sectorInversion.index')}}">Gestionar Sector de Inversion</a></li>
                                <li><a href="{{route('requisito.index')}}">Gestionar Requisitos</a></li>
                                <li><a href="{{route('lista.index')}}">Gestionar Lista de Chequeo Red</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestionar Listas de Chequeo Municipio</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{route('reqM')}}">Gestionar Requisitos Municipales</a></li>
                                        <li><a href="{{route('lisM')}}">Gestionar Lista de Chequeo Municipio</a></li>
                                        <li class="divider"></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestionar Evidencias</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('formatoEvidencia.index')}}">Gestionar Formatos</a></li>
                                <li><a href="#">Gestionar Formatos Email</a></li>
                                <li class="divider"></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class=" nav navbar-right dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-user"></i>  {{Auth::user()->user_login}} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Cerrar Sesión </a></li>
                    </ul>
                </li>
            </ul>

        </div>

    </div>

</nav>