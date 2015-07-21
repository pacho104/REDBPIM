@extends('template.main')

@section('title') Red BPIM - Iniciar Sesión @endsection

@section('content')
    @include('template.partials.loginbar')
    <div class="container-fluid crolsant">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Iniciar Sesión</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger" style="background-color:#ff4a3d" >
							<strong>Ups!</strong> Exiten problemas con los campos ingresados. <br><br>
							<ul>
								@foreach ($errors->all() as $error)
                                    <li>{!! $error !!}</li>
								@endforeach
							</ul>
						</div>
					@endif

                    <form class="form-horizontal" role="form" method="POST" action="/auth/login">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
							<label class="col-md-4 control-label">Correo Electrónico</label>
							<div class="col-md-6">
								<input type="email" class="form-control" placeholder="Escriba su correo electrónico"  name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Contraseña</label>
							<div class="col-md-6">
								<input type="password" class="form-control" placeholder="Escriba su contraseña" name="password">
							</div>
						</div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Rol de usuario</label>

                                <div class="col-md-6">
                                    {!! Form::select('rol_usuario',
                                    (['0' => 'Seleccione su rol de usuario'] + $listroles),
                                    null,
                                    ['class' => 'form-control'])
                                    !!}
                                </div>
                            </div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Mantener sesión iniciada
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
									Iniciar Sesión
								</button>

								<a href="../password/email">Olvidó su clave de acceso?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
