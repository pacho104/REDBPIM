@extends('template.main')
@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection
@section('content')

    @include('template.partials.logbar_sec')

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
                    Actualización de Información
                </h3>
            </div>
        </div>
    </div>
    <br>

    <div class="container">
        <div class="col-md-2"></div>
        <div class="col-md-8">

            {!! Form::open(['url' => '/user/'.$user_refresh->id.'/refresh', 'autocomplete' => 'off']) !!}

            <fieldset>

                <div class="form-group">
                    <label class="col-md-3 control-label">Nombres:</label>

                    <div class="col-md-7">
                        <input type="text" name="nombres" value="{{old('nombres',$user_refresh->nom_usuario)}}"
                               class="form-control">
                    </div>
                </div>
                <br><br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Apellidos:</label>

                    <div class="col-md-7">
                        <input type="text" class="form-control" name="apellidos"
                               placeholder="ingrese sus apellidos completos"
                               value="{{ old('apellidos',$user_refresh->ape_usuario)}}">
                    </div>
                </div>
                <br><br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Tipo de Identificación:</label>

                    <div class="col-md-7">
                        {!! Form::select('tipo_identificacion',
                        ($list_tipidentificacion),
                        $user_refresh->id_tipo_identificacion,
                        ['class' => 'form-control'])
                        !!}
                    </div>
                </div>
                <br><br>

                <div class="form-group">
                    <label class="col-md-3 control-label"> Número de Identificación:</label>

                    <div class="col-md-7">
                        <input id="onlynumbers" type="text" class="form-control" name="numero_identificacion"
                               placeholder="ingrese su número de identificación"
                               value="{{ old('numero_identificacion',$user_refresh->num_identificacion)}}">
                    </div>
                </div>
                <br><br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Télefono Usuario:</label>

                    <div class="col-md-7">
                        <input type="text" class="form-control" name="telefono_usuario"
                               value="{{ old('telefono_usuario',$user_refresh->tel_usuario)}}">
                    </div>
                </div>
                <br><br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Número de Celular:</label>

                    <div class="col-md-7">
                        <input type="text" class="form-control" name="celular_usuario"
                               value="{{ old('celular_usuario',$user_refresh->cel_usuario)}}">
                    </div>
                </div>
                <br><br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Secretaría:</label>

                    <div class="col-md-7">
                        {!! Form::select('secretaria',
                        ($list_secretaria),
                        $user_refresh->id_tipo_secretaria,
                        ['class' => 'form-control'])
                        !!}
                    </div>
                </div>
                <br><br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Cargo Usuario::</label>

                    <div class="col-md-7">
                        {!! Form::select('cargo_usuario',
                        ($list_cargo),
                        $user_refresh->id_cargo_usuario,
                        ['class' => 'form-control'])
                        !!}
                    </div>
                </div>
                <br><br>


                <div class="form-group">
                    <label class="col-md-3 control-label">Nombre Usuario:</label>

                    <div class="col-md-7">
                        <input id='myInput' type="text" name="nombre_usuario"
                               placeholder="ingrese su usuario de login ej: pedro123"
                               value="{{old('nombre_usuario',$user_refresh->user_login)}}" class="form-control">
                    </div>
                </div>
                <br><br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Correo Electrónico:</label>

                    <div class="col-md-7">
                        <input type="email" name="correo_electronico"
                               placeholder="ingrese su e-mail ej: alguien@example.com"
                               value="{{old('correo_electronico',$user_refresh->email)}}" class="form-control">
                    </div>
                </div>
                <br><br>

                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal">
                    Actualizar
                </button>
                <br><br>

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
        <div class="col-md-2"></div>
    </div>
    </div>
@stop