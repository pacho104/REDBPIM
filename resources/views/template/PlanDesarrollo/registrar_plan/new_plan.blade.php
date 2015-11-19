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

        <div class="container-fluid ">
            <div class="col-md-1"> </div>
            <fieldset>
                <ul class="nav nav-tabs " >
                    <li class="active col-lg-2"><a href="{{route('new_plan_municipal')}}"><big> 1. </big>Plan de desarrollo</a></li>
                    <li class="disabled col-md-2"><a><big> 2. </big>Eje estratégico</a></li>
                    <li class="disabled col-md-2"><a><big> 3. </big>Programa</a></li>
                    <li class="disabled col-md-2"><a><big> 4. </big>Sub-Programa</a></li>
                    <li class="disabled col-md-2"><a><big> 5. </big>Metas</a></li>
                </ul>
            </fieldset>
        </div>
        <br><br>

        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {!! Form::open(['url' => 'admin/plan_desarrollo/new_plan', 'autocomplete' => 'off']) !!}
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Código del plan de desarrollo:</label>
                        <div class="col-md-8">
                            <input id="onlynumbers" type="text" class="form-control" name="codigo_plan"
                                   placeholder="ingrese el código del plan de desarrollo" value="{{ old('codigo_plan')}}">
                        </div>
                    </div>
                    <br><br>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Nombre del plan de desarrollo:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="nombre_plan"
                                   placeholder="ingrese el nombre del plan de desarrollo" value="{{ old('nombre_plan')}}">
                        </div>
                    </div>
                    <br><br>

                    <button type="submit" class="btn btn-block btn-primary"> Guardar Cambios </button>

                </fieldset>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop

