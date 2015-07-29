@extends('template.main')

@section('title') Red BPIM - Registro de Usuario @endsection

@section('content')

    @include('template.partials.loginbar')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Registrar Usuario</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger", style="background-color:#ff4a3d">
                            <strong>Verifique La Información!</strong> Exiten problemas con los campos ingresados. <br><br>
							<ul>
								@foreach ($errors->all() as $error)
                                    <li>{!! $error !!}</li>
								@endforeach
							</ul>
						</div>
                    @endif

                    <form class="form-horizontal crolsant" role="form" method="POST" action="../auth/register">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Nombres:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nombres"
                                    placeholder="ingrese sus nombres completos" value="{{ old('nombres') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Apellidos:</label>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control" name="apellidos"
                                    placeholder="ingrese sus apellidos completos" value="{{ old('apellidos')}}">
                                    </div>
                            </div>


                           <div class="form-group">
                                <label class="col-md-4 control-label">Tipo de Identificación: </label>
                                <div class="col-md-6">
                                        {!! Form::select('tipo_identificacion',
                                        (['0' => 'Seleccione el tipo de identificación'] + $list_tipidentificacion),
                                        null,
                                        ['class' => 'form-control'])
                                        !!}
                                </div>
                            </div>


                           <div class="form-group">
                                <label class="col-md-4 control-label"> Número de Identificación:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="numero_identificacion"
                                           placeholder="ingrese su número de identificación"
                                           value="{{ old('numero_identificacion')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Télefono Fijo:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="telefono_usuario"
                                    value="{{ old('telefono_usuario') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Número de Celular:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="celular_usuario"
                                    value="{{ old('celular_usuario') }}" required pattern="[0-9]"
                                    title="Solo Numeros Enteros sin puntos ni comas">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Municipio:</label>
                                <div class="col-md-6">
                                        {!! Form::select('municipio',
                                        (['0' => 'Seleccione un municipio'] + $list_municipio),
                                        null,
                                        ['class' => 'form-control'])
                                        !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Secretaría:</label>
                                    <div class="col-md-6">
                                        {!! Form::select('secretaria',
                                        (['0' => 'Seleccione la secretaría a la cuál aplica'] + $list_secretaria),
                                        null,
                                        ['class' => 'form-control'])
                                        !!}
                                    </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Cargo Usuario:</label>
                                <div class="col-md-6">
                                    {!! Form::select('cargo_usuario',
                                    (['0' => 'Seleccione su cargo de trabajo'] + $list_cargo),
                                    null,
                                    ['class' => 'form-control'])
                                    !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Nombre de Usuario:</label>
                                <div class="col-md-6">
                                    <input id="myInput" type="text" class="form-control" name="nombre_usuario"
                                    placeholder="ingrese el usuario de registro al sistema ej: pedro123"
                                    value="{{ old('nombre_usuario') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Correo Electrónico:</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control"
                                   name="correo_electronico" placeholder="ingrese su e-mail ej: alguien@example.com"
                                   value="{{ old('correo_electronico') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Rol de Usuario::</label>

                                <div class="col-md-6">
                                    {!! Form::select('rol_usuario',
                                    (['0' => 'Seleccione el rol al cuál aplica'] + $listroles),
                                    null,
                                    ['class' => 'form-control'])
                                    !!}
                                </div>
                            </div>


                        <div class="form-group">
                                <label class="col-md-4 control-label">Contraseña:</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="contrasenia">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Vuelva a escribir su contraseña:</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="contrasenia_confirmation">
                                </div>
                            </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Recaptcha:</label>
                            <div class="col-md-6">
                                {!! Form::captcha()!!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 ">
                                <button type="submit" class="btn btn-primary" style="margin-right: 15px">
                                    Registrar Usuario
                                </button>
                            </div>
                        </div>

                    </form>

				</div>
			</div>
		</div>
	</div>

</div>

@endsection


