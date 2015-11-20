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

            @if(\Session::has('ValidationDeleteCargo'))
                <div id="dangercolor" class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fa fa-exclamation-triangle"></i>
                    {{Session::get('ValidationDeleteCargo')}}
                </div>
            @endif

            <ul id="alignrightCreate" class="nav nav-tabs navbarfont navbar-right">
                <li><a href="{{route('nuevo_cargo')}}">
                        <i class="fa fa-plus"></i> &nbsp Crear nuevo Cargo </a></li>
            </ul>
                {!!Form::model(Request::all(),['route'=>'cargoUsuario','method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
                <div class="form-group">
                    {!!Form::text('cargo',null,['class'=>'form-control','placeholder'=>'Cargo'])!!}
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
                {!!Form::close()!!}

            <table class="table table-striped  table-bordered">
                <thead>
                <th class="col-md-1">Identificador</th>
                <th class="col-md-4">Nombre del cargo laboral</th>
                <th class="col-md-1">Acciones</th>
                </thead>
                <tbody>
                @foreach($cargo_usuario as $cargo)
                    <tr>
                        <td>{{$cargo->id}}</td>
                        <td>{{$cargo->nom_cargo}}</td>
                        <td>
                            <div class="btn-group-justified">
                                <a href="cargo_usuario/{{$cargo->id}}/editar" class="btn btn-warning">
                                    <i class="fa fa-edit"> </i> </a>
                                <a data-toggle="modal" data-target="#ConfirmDelete-{{$cargo->id}}"
                                   href="#ConfirmDelete-{{$cargo->id}}"
                                   class="btn btn-danger"><i class="fa fa-trash"></i> </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @foreach($cargo_usuario as $carg_delete)
                <div class="modal" id="ConfirmDelete-{{$carg_delete->id}}">
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
                                <a name="a" href="cargo_usuario/{{$carg_delete->id}}/eliminar" class="btn btn-danger">Eliminar
                                    Registro</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-2"></div>
        <div class="container" align="center">
           {!!$cargo_usuario->appends(Request::only(['cargo']))->render()!!}
        </div>
    </div>
@stop