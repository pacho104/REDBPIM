@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection


@section('content')

    @include('template.partials.logbar')
    {!! HTML::style('public/css/multi-select.css') !!}
    {!! HTML::script('public/js/jquery.multi-select.js') !!}


    <div class="row-fluid">
        <div class="container"  id="admin">

                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong></strong>
                </div>

                <div id="dangercolor" class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fa fa-exclamation-triangle"></i>

                </div>

                <ul id="alignrightCreate" class="nav nav-tabs navbarfont navbar-right">
                    <li >
                        <a href="{{route('roles.create')}}">
                            <i class="fa fa-plus"></i>
                            Crear Nuevo Rol
                        </a></li>
                    <br><br>
                </ul>
            <br>

                <table class="table table-striped  table-bordered">
                    <thead>
                        <th class="col-md-4">Nombre</th>
                        <th class="col-md-4">Descripción</th>
                        <th class="foo">Permisos</th>
                        <th class="foo">Acciones</th>
                    </thead>
                        <tbody>
                            @foreach($roles as $rol)
                                <tr>
                                    <td>{{$rol->name}}</td>
                                    <td>{{$rol->description}}</td>
                                    <td>
                                        <a data-toggle="modal" rol_id="{{ $rol->id }}" data-target="#permisos" class="btn btn-success get-permisos">Permisos
                                        </a>
                                    </td>
                                    <td>
                                        <div class="btn-group-justified">
                                            <a  href="#" class="btn btn-primary">
                                                Editar
                                            </a>
                                            <a data-toggle="modal" data-target="#ConfirmDelete-{{$rol->id}}" href="#ConfirmDelete-{{$rol->id}}"
                                               class="btn btn-danger">
                                               Eliminar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
        </div>

    </div>
@stop

<div class="col-md-2"></div>
<div class="container" align="center">
    <div class="modal" id="permisos">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Gestionar permisos</h4>
                </div>
                <div class="modal-body">
                    <select id="select-permisos" multiple="multiple">
                       @if(isset($permisos))
                            @foreach($permisos as $permiso)
                                <option value="{{ $permiso->id }}">{{ $permiso->display_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Salir</a>
                </div>
            </div>
        </div>
    </div>
</div>

