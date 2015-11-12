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

        <div class="container">
            <div class="jumbotrom">
                <h3 class="text-center">
                    Edición de Sub-Programa
                </h3>
            </div>
        </div>
        <br>

        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {!! Form::open(['url' => 'admin/plan_desarrollo/subPrograma/'.$subPrograma->id.'/refresh', 'autocomplete' => 'off']) !!}

                <fieldset>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Código del Sub-Programa:</label>
                        <div class="col-md-9">
                            <input id="onlynumbers" type="text" class="form-control" name="codigo_sub_programa"
                                   placeholder="ingrese el código del programa" value="{{old('codigo_sub_programa',$subPrograma->codigo_sub_programa)}}">
                        </div>
                    </div>
                    <br><br>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Nombre del Sub-Programa:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nombre_sub_programa"
                                   placeholder="ingrese el nombre del programa" value="{{old('nombre_sub_programa',$subPrograma->nombre_sub_programa)}}">
                        </div>
                    </div>
                    <br><br>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Programa:</label>
                        <div class="col-md-9">
                            {!! Form::select('programa',
                            ($list_programa),
                            $subPrograma->id_programa,
                            ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>
                    <br><br>

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

