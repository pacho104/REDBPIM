@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection

@section('content')

    @include('template.partials.logbar')

    <div class="row-fluid">
        <div class="container"  id="admin">
            @if(\Session::has('alert'))
                <div class="alert alert-dismissible alert-success fontbig">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{Session::get('alert')}}</strong>
                </div>
            @endif

                @if(\Session::has('ValidationDelete'))
                    <div id="dangercolor" class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <i class="fa fa-exclamation-triangle"></i>
                        {{Session::get('ValidationDelete')}}
                </div>
            @endif

                <ul id="alignrightCreate" class="nav nav-tabs navbarfont navbar-right">
                <li ><a href="{{route('nuevo_dep')}}">
                        <i class="fa fa-plus"></i> &nbsp Crear nuevo Departamento </a></li>
                    <br><br>
            </ul>
            <br>

            <table class="table table-striped  table-bordered">
                <thead>
                <th class="col-md-4">Código Dane del Departamento</th>
                <th class="col-md-5">Nombre del Departamento</th>
                    <th class="foo">Acciones</th>
                </thead>
                <tbody>
                    @foreach($departamento as $dep)
                        <tr>
                            <td>{{$dep->cod_dane_dep}}</td>
                            <td>{{$dep->nom_departamento}}</td>
                            <td>
                                <div class="btn-group-justified">
                                    <a  href="departamento/{{$dep->id}}/editar" class="btn btn-warning"><i class="fa fa-edit"> </i></a>
                                    <a data-toggle="modal" data-target="#ConfirmDelete-{{$dep->id}}" href="#ConfirmDelete-{{$dep->id}}"
                                       class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @foreach($departamento as $delete)
                <div class="modal" id="ConfirmDelete-{{$delete->id}}">
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
                                <a name="a" href="departamento/{{$delete->id}}/eliminar" class="btn btn-danger">Eliminar Registro</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-2"></div>
        <div class="container" align="center">
            <?php echo str_replace('/?', '?', $departamento->render()) ?>
        </div>
    </div>
@stop