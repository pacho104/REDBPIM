@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection

@section('search')

    @include('template.partials.logbar_admin')

    {!! Form::open(['url' => 'admin/verificar_roles/search', 'autocomplete' => 'off']) !!}

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Búsqueda de usuario - ingrese los parámetros de búsqueda</h3>
            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
        </div>
        <div class="panel-body form-horizontal">
            <label class="col-sm-1 control-label">Nombres:</label>

            <div class="col-sm-2">
                <input type="text" name="nom_usuario" class="form-control" placeholder="ingrese los nombres">
            </div>
            <label class="col-sm-1 control-label">Apellidos:</label>

            <div class="col-sm-3">
                <input type="text" name="ape_usuario" class="form-control"
                       placeholder="ingrese los apellidos del usuario">
            </div>
            <label class="col-sm-2 control-label">Número de Identificación:</label>

            <div class="col-sm-3">
                <input type="text" class="form-control" name="num_identificacion"
                       placeholder="ingrese el número de identificación">
            </div>
            <label class="col-sm-1 control-label ">Municipio:</label>

            <div class="col-sm-2">
                {!! Form::select('municipio',
                (['0' => ''] + $list_municipio),
                null,
                ['class' => 'form-control'])
                !!}
            </div>
            <label class="col-sm-1 control-label">Secretaría:</label>

            <div class="col-sm-3">
                {!! Form::select('secretaria',
                (['0' => ''] + $list_secretaria),
                null,
                ['class' => 'form-control'])
                !!}
            </div>
            <label class="col-sm-2 control-label">Cargo laboral:</label>

            <div class="col-sm-3">
                {!! Form::select('cargo',
                (['0' => ''] + $list_cargo),
                null,
                ['class' => 'form-control'])
                !!}
                <br>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

@stop