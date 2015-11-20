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
                    <li class="active col-md-2"><a href="{{'new_subPrograma'}}"><big> 4. </big>Sub-Programa</a></li>
                    <li class="disabled col-md-2"><a><big> 5. </big>Metas</a></li>
                </ul>
            </fieldset>
        </div>
        <br>

        <div class="container" align="center">
            <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel panel-info">
                            <div class="panel-heading" align="center">
                                <h3 class="panel-title">Información</h3>
                            </div>
                            <div class="panel-body" align="justify">
                                Importante..!  Si el plan de Desarrollo no presenta sub-Programas continue con el siguiente paso.
                            </div>
                    </div>
            </div>
        </div>


        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {!! Form::open(['url' => 'admin/plan_desarrollo/new_subPrograma', 'autocomplete' => 'off']) !!}
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Código del subPrograma:</label>
                        <div class="col-md-8">
                            <input id="onlynumbers" type="text" class="form-control" name="codigo_subPrograma"
                                   placeholder="ingrese el código del programa" value="{{ old('codigo_subPrograma')}}">
                        </div>
                    </div>
                    <br><br>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Nombre del Sub-Programa:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="nombre_subPrograma"
                                   placeholder="ingrese el nombre del programa" value="{{ old('nombre_subPrograma')}}">
                        </div>
                    </div>
                    <br><br>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Programa:</label>
                        <div class="col-md-8">
                            {!! Form::select('programa',
                            (['0' => 'Seleccione el programa al cuál pertenece'] + $list_programa),
                            null,
                            ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>
                    <br><br>

                    <button type="submit" class="btn btn-block btn-primary"> Guardar Cambios </button>

                </fieldset>
                {!! Form::close() !!}

            </div>
        </div>

        <br>
        <div class="container">
            <div class="col-md-3"></div>
            <div class="col-md-7">
                <ul class="pager">
                    <li><a href="{{route('new_programa')}}"> <i class="fa fa-angle-double-left"></i> Anterior </a></li>
                    <li><a href="{{route('new_meta')}}">Siguiente <i class="fa fa-angle-double-right"></i> </a></li>
                    <li class="next"><a href="{{route('plan_desarrollo')}}"> <i class="fa fa-list"></i>  Finalizar  </a></li>
                </ul>
            </div>
        </div>
    </div>
@stop

