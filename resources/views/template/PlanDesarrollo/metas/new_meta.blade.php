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

        @if(\Session::has('alert'))
            <div class="alert alert-dismissible alert-success fontbig">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{Session::get('alert')}}</strong>
            </div>
        @endif

        @if(\Session::has('alertError'))
            <div id="dangercolor" class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{Session::get('alertError')}}</strong>
            </div>
        @endif

        <div class="container-fluid ">
            <div class="col-md-1"> </div>
            <fieldset>
                <ul class="nav nav-tabs " >
                    <li class="disabled col-lg-2"><a><big> 1. </big>Plan de desarrollo</a></li>
                    <li class="disabled col-md-2"><a><big> 2. </big>Eje estratégico</a></li>
                    <li class="disabled col-md-2"><a><big> 3. </big>Programa</a></li>
                    <li class="disabled col-md-2"><a><big> 4. </big>Sub-Programa</a></li>
                    <li class="active col-md-2"><a href="{{route('new_meta')}}"><big> 5. </big>Metas</a></li>
                </ul>
            </fieldset>
        </div>
        <br>


        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {!! Form::open(['url' => 'admin/plan_desarrollo/new_meta', 'autocomplete' => 'off']) !!}
                <fieldset>

                    <div class="panel panel-primary">
                        <div class="panel-heading">1. Seleccione el Programa-SubPrograma que aplica la meta.</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Programa-SubPrograma:</label>
                                <div class="col-md-8">
                                    <select name="select_programa" id="select_programa" class="form-control">
                                        <option value="0">Elija si la meta pertenece a un programa o sub-programa</option>
                                        <option value="1">Programa</option>
                                        <option value="2">Sub-Programa</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group" id="valuePrograma">
                                <label class="col-md-3 control-label">Nombre:</label>
                                <div class="col-md-8">
                                    {!! Form::select('programa',
                                    (['0' => 'Seleccione el programa al cuál aplica la meta'] + $list_programa),
                                    null,
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
                                           placeholder="ingrese el nombre de la meta" value="{{ old('nombre_meta')}}">
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Tipo de Meta:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="tipo_meta"
                                           placeholder="ingrese el tipo de meta" value="{{ old('tipo_meta')}}">
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Valor de la Meta:</label>
                                <div class="col-md-9">
                                    <input id="onlynumbers" type="text" class="form-control" name="valor_meta"
                                           placeholder="ingrese el valor de la meta" value="{{ old('valor_meta')}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block btn-primary"> Guardar Cambios </button>

                </fieldset>
                {!! Form::close() !!}

            </div>
        </div>

        <br>

        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <ul class="pager">
                    <li ><a href="{{route('new_subPrograma')}}"> <i class="fa fa-angle-double-left"></i> Anterior </a></li>
                    <li><a href="{{route('finish_meta')}}"> Finalizar <i class="fa fa-angle-double-right"></i> </a></li>
                </ul>
            </div>
        </div>
    </div>

@stop

