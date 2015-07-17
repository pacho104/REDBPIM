@extends('template.main')

@section('title'){{ 'Escritorio | ' . Auth::user()->login_user }} @endsection

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
            @if (count($errors) > 0)
                    <div id="dangercolor" class="alert alert-danger">
                        <strong>Ups!</strong> Exiten problemas con los campos ingresados. <br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif

                <ul class="nav nav-tabs navbarfont">
                    <li ><a href="{{route('nuevo_mun')}}">
                    <i class="fa fa-plus"></i> &nbsp Crear nuevo Municipio </a> </li>
                </ul>

                <br>

                <table class="table table-striped  table-bordered">
                        <thead>
                            <th>Código Dane del Municipio</th>
                            <th> Nombre del Municipio</th>
                            <th>Nombre del Departamento</th>
                            <th class="foo">Acciones</th>
                        </thead>
                    <tbody>
                    @foreach($municipio as $mun)
                        <tr>
                            <td>{{$mun->cod_dane_mun}}</td>
                            <td>{{$mun->nom_municipio}}</td>
                            <td>{{$mun->nom_departamento}}</td>
                            <td>
                                <div class="btn-group-justified">
                                <a  href="municipio/{{$mun->id}}/editar" class="btn btn-warning"><i class="fa fa-edit"> </i></a>
                                <a data-toggle="modal" data-target="#ConfirmDelete-{{$mun->id}}" href="#ConfirmDelete-{{$mun->id}}"
                                   class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @foreach($municipio as $delete)
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
                                    <a href="municipio/{{$delete->id}}/eliminar" class="btn btn-danger">Eliminar Registro</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
@stop