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
                        <li class="active col-md-2"><a href="{{route('new_programa')}}"><big> 3. </big>Programa</a></li>
                        <li class="disabled col-md-2"><a><big> 4. </big>Sub-Programa</a></li>
                        <li class="disabled col-md-2"><a><big> 5. </big>Metas</a></li>
                    </ul>
                </fieldset>
        </div>
        <br><br>

        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {!! Form::open(['url' => 'admin/plan_desarrollo/new_programa', 'autocomplete' => 'off']) !!}

                <fieldset>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Código del Programa:</label>
                        <div class="col-md-9">
                            <input id="onlynumbers" type="text" class="form-control" name="codigo_programa"
                                   placeholder="ingrese el código del programa" value="{{ old('codigo_programa')}}">
                        </div>
                    </div>
                    <br><br>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Nombre del Programa:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nombre_programa"
                                   placeholder="ingrese el nombre del programa" value="{{ old('nombre_programa')}}">
                        </div>
                    </div>
                    <br><br>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Eje estratégico:</label>
                        <div class="col-md-9">
                            {!! Form::select('eje_estrategico',
                            (['0' => 'Seleccione el eje estratégico del programa'] + $list_eje),
                            null,
                            ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>
                    <br><br>

                    <button type="submit" class="btn btn-block btn-primary"> Guardar Cambios </button>
                    <br>
                </fieldset>
                {!! Form::close() !!}

           </div>
        </div>

        <div class="container">
            <div class="col-md-3"></div>
            <div class="col-md-7">
                <ul class="pager">
                    <li><a href="{{route('new_eje_estrategico')}}"> <i class="fa fa-angle-double-left"></i> Anterior </a></li>
                    <li><a href="{{route('next_programa')}}">Siguiente <i class="fa fa-angle-double-right"></i> </a> </li>
                    <li class="next"><a href="{{route('plan_desarrollo')}}"> <i class="fa fa-list"></i>  Finalizar  </a></li>
                </ul>
            </div>
        </div>

    </div>

@stop

