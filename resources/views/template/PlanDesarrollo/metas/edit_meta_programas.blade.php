@extends('template.main')
@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection
@section('content')

    @include('template.partials.logbar_admin')

    <div class="row-fluid">

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

        @if(\Session::has('alertError'))
            <div id="dangercolor" class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{Session::get('alertError')}}</strong>
            </div>
        @endif

        <div class="container">
            <div class="jumbotrom">
                <h3 class="text-center">
                    Edición de la meta
                </h3>
            </div>
        </div>
        <br>

        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {!! Form::open(['url' => 'admin/plan_desarrollo/meta/programa/'.$meta->id.'/refresh', 'autocomplete' => 'off']) !!}
                <fieldset>

                    <div class="panel panel-primary">
                        <div class="panel-heading">1. Seleccione el Programa-SubPrograma que aplica la meta.</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Programa-SubPrograma:</label>
                                <div class="col-md-8">
                                    <select name="select_programa" id="select_programa" class="form-control">
                                        <option value="1">Programa</option>
                                        <option value="2">Sub-Programa</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group" id="valueProgramaedit">
                                <label class="col-md-3 control-label">Nombre:</label>
                                <div class="col-md-8">
                                    {!! Form::select('programa',
                                    ($list_programa),
                                    $metaprograma->id_programa,
                                    ['class' => 'form-control'])
                                    !!}
                                </div>
                            </div>
                            <div class="form-group" id="valuesubPrograma">
                                <label class="col-md-3 control-label">Nombre:</label>
                                <div class="col-md-8">
                                    {!! Form::select('subPrograma',
                                    (['0' => 'Seleccione el sub-programa al cuál aplica la meta'] + $list_subPrograma),
                                    null,
                                    ['class' => 'form-control'])
                                    !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">2. Registro de Meta</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nombre de la Meta:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="nombre_meta"
                                           placeholder="ingrese el nombre de la meta" value="{{old('nombre_meta',$meta->nombre_meta)}}">
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Tipo de Meta:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="tipo_meta"
                                           placeholder="ingrese el tipo de meta" value="{{old('tipo_meta',$meta->tipo_meta)}}">
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Valor de la Meta:</label>
                                <div class="col-md-9">
                                    <input id="onlynumbers" type="text" class="form-control" name="valor_meta"
                                           placeholder="ingrese el valor de la meta" value="{{old('valor_meta',$meta->valor_meta)}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal">
                        Actualizar
                    </button>

                    <div id="myModal" class="modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                    </button>
                                    <h4 class="modal-title">Confirmación</h4>
                                </div>
                                <div class="modal-body">
                                    <h6>¿Realmente desea guardar los cambios realizados?</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@stop

