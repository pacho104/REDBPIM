@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection

@section('content')

    @include('template.partials.logbar')

    <div class="row-fluid">
        <div class="container" id="admin">
            @if(\Session::has('alert'))
                <div class="alert alert-dismissible alert-success fontbig">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{Session::get('alert')}}</strong>
                </div>
            @endif

            @if(\Session::has('ValidationDeleteIdentificacion'))
                <div id="dangercolor" class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fa fa-exclamation-triangle"></i>
                    {{Session::get('ValidationDeleteIdentificacion')}}
                </div>
            @endif

            <ul id="alignrightCreate" class="nav nav-tabs navbarfont navbar-right">
                <li><a href="{{route('new_identificacion')}}">
                        <i class="fa fa-plus"></i> &nbsp Crear nuevo tipo de identificación </a></li>
            </ul>
                {!!Form::model(Request::all(),['route'=>'tipoIdentificacion','method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
                <div class="form-group">
                    {!!Form::text('identi',null,['class'=>'form-control','placeholder'=>'Tipo Identificación'])!!}
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
                {!!Form::close()!!}


            <table class="table table-striped  table-bordered">
                <thead>
                <th class="col-md-1">Identificador</th>
                <th class="col-md-4">Nombre del tipo de identificación</th>
                <th class="col-md-1">Acciones</th>
                </thead>
                <tbody>
                @foreach($tip_identificacion as $identif)
                    <tr>
                        <td>{{$identif->id}}</td>
                        <td>{{$identif->nom_identificacion}}</td>
                        <td>
                            <div class="btn-group-justified">
                                <a href="tipo_identificacion/{{$identif->id}}/editar" class="btn btn-warning"><i
                                            class="fa fa-edit"> </i></a>
                                <a data-toggle="modal" data-target="#ConfirmDelete-{{$identif->id}}"
                                   href="#ConfirmDelete-{{$identif->id}}"
                                   class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @foreach($tip_identificacion as $identif_delete)
                <div class="modal" id="ConfirmDelete-{{$identif_delete->id}}">
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
                                <a name="a" href="tipo_identificacion/{{$identif_delete->id}}/eliminar"
                                   class="btn btn-danger">Eliminar Registro</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-2"></div>
        <div class="container" align="center">
            {!!$tip_identificacion->appends(Request::only(['identi']))->render()!!}
        </div>
    </div>
@stop