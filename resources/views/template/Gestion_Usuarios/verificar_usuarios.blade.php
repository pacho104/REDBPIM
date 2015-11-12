@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection

@section('content')

    @include('template.partials.logbar_admin')

    <div class="row-fluid">
        <div class="container" id="admin">

            @if(\Session::has('alertReject'))
                <div class="alert alert-dismissible alert-success fontbig">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{Session::get('alertReject')}}</strong>
                </div>
            @endif
            @if(\Session::has('alertAccept'))
                <div class="alert alert-dismissible alert-success fontbig">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{Session::get('alertAccept')}}</strong>
                </div>
            @endif

            <table class="table table-striped  table-bordered">
                <thead>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Municipio</th>
                <th>Secretaría</th>
                <th>Correo electrónico</th>
                <th>Rol de usuario</th>
                <th class="sec">Acciones</th>
                </thead>
                <tbody>
                @foreach($userverif as $user)
                    <tr>
                        <td>{{$user->nom_usuario}}</td>
                        <td>{{$user->ape_usuario}}</td>
                        <td>{{$user->nom_municipio}}</td>
                        <td>{{$user->nombre_secretaria}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->description}}</td>
                        <td>
                            <div class="btn-group-justified">

                                <a data-toggle="modal" data-target="#ConfirmAcept-{{$user->id}}"
                                   href="#ConfirmAcept-{{$user->id}}"
                                   class="btn btn-primary">Aceptar</a>
                                <a data-toggle="modal" data-target="#ConfirmReject-{{$user->id}}"
                                   href="#ConfirmReject-{{$user->id}}"
                                   class="btn btn-danger">Descartar</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @foreach($userverif as $user_reject)
                <div class="modal" id="ConfirmReject-{{$user_reject->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                                <h6>El usuario será eliminado del sistema. <br> <br>¿Realmente desea descartar al
                                    usuario seleccionado?</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <a href="verificar_usuarios/{{$user_reject->id}}/descartar" class="btn btn-danger">Descartar
                                    Registro</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach($userverif as $useraccept)
                <div class="modal" id="ConfirmAcept-{{$useraccept->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                                <h6>¿Realmente desea guardar los cambios realizados?</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <a href="verificar_usuarios/{{$useraccept->id}}/aceptar" class="btn btn-primary">Guardar
                                    Cambios</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="col-md-2"></div>
        <div class="container" align="center">
            <?php echo str_replace('/?', '?', $userverif->render()) ?>
        </div>

    </div>

@stop