@extends('template.main')
@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection
@section('content')

    @include('template.partials.logbar_admin')

    <div class="row-fluid">
        <div class="container" id="admin">
            @if(\Session::has('alert'))
                <div class="alert alert-dismissible alert-success fontbig">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{Session::get('alert')}}</strong>
                </div>
            @endif

            <ul id="alignrightCreate" class="nav nav-tabs navbarfont navbar-right">
                <li><a href="{{route('new_biblioteca')}}">
                        <i class="fa fa-plus"></i> &nbsp Crear nueva biblioteca </a></li>
                <br><br>
            </ul>
            <br>

            <table class="table table-striped  table-bordered">
                <thead>
                <th>Departamento al cuál aplica</th>
                <th>Título de la biblioteca</th>
                <th>Contenido</th>
                <th class="foo">Acciones</th>
                </thead>
                <tbody>
                @foreach($biblioteca as $bibliot)
                    <tr>
                        <td>{{$bibliot->nom_departamento}}</td>
                        <td>{{$bibliot->titulo_biblioteca}}</td>
                        <td>
                            <div class="textareaContent">{!!$bibliot->documento_biblioteca!!}</div>
                        </td>
                        <td>
                            <div class="btn-group-justified ">
                                <a data-original-title="Tooltip on top" href="biblioteca/{{$bibliot->id}}/editar"
                                   class="btn btn-warning"><i class="fa fa-edit"> </i></a>
                                <a data-toggle="modal" data-target="#ConfirmDelete-{{$bibliot->id}}"
                                   href="#ConfirmDelete-{{$bibliot->id}}"
                                   class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @foreach($biblioteca as $deletebiblioteca)
                <div class="modal" id="ConfirmDelete-{{$deletebiblioteca->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                                <h6>¿Realmente desea eliminar el registro seleccionado?</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <a name="a" href="biblioteca/{{$deletebiblioteca->id}}/eliminar" class="btn btn-danger">Eliminar
                                    Registro</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-2"></div>
        <div class="container" align="center">
            <?php echo str_replace('/?', '?', $biblioteca->render()) ?>
        </div>
    </div>
@stop