@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }}

@endsection

@section('search')
    @include('template.Gestion_usuarios.roles_usuarios')
@endsection

@section('content')

    @if($errors->has('alertBadRol'))
        <div id="dangercolor" class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{$errors->first('alertBadRol')}}</strong>
        </div>
    @endif

    @if($errors->has('alerSuccesRol'))
        <div class="alert alert-dismissible alert-success fontbig">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{$errors->first('alerSuccesRol')}}</strong>
        </div>
    @endif

    <table class="table table-striped table-bordered ">
        <thead>
        <th>Nombre</th>
        <th>N° de identificación</th>
        <th> Asignar Roles</th>
        <th> Acción</th>
        </thead>
        <tbody>
        @foreach($users as $user)

            {!! Form::open(['url' => '/admin/verificar_roles/'.$user->id.'/new_rol', 'autocomplete' => 'off']) !!}

            <?php

            $roleasignado = \App\User::find($user->id)->roles()->get();

            $rolesall = \DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->join('roles', 'roles.id', '=', 'role_user.role_id')
                    ->select('roles.level')
                    ->where('users.id', '=', $user->id)
                    ->get();

            $roles_levels = array_map(function ($todosroles) {
                return $todosroles->level;
            }, $rolesall);

            if (\Auth::user()->level() == 5) {
                $rolenew = \DB::table('roles')
                        ->whereNotIn('level', array(1))
                        ->whereNotIn('level', $roles_levels)
                        ->get();
            }
            if (\Auth::user()->level() == 4) {
                $rolenew = \DB::table('roles')
                        ->whereNotIn('level', array(3, 5))
                        ->whereNotIn('level', $roles_levels)
                        ->get();
            }
            ?>

            <tr>
                <td>{{$user->nom_usuario .' '. $user->ape_usuario }} </td>
                <td>{{$user->num_identificacion}} </td>
                <td>
                    @foreach($roleasignado as $role)
                        {!!Form::checkbox('user'.$user->id.'level' . $role->level, '1', 'checked')!!}
                        <label> {{$role->description}}</label> <br>
                    @endforeach
                    @foreach($rolenew as $rolesnuevos)
                        {!!Form::checkbox('user'.$user->id.'level' . $rolesnuevos->level, 'checked')!!}
                        <label> {{$rolesnuevos->description}}</label> <br>
                    @endforeach
                </td>
                <td align="center" style="padding-top: 3em">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o fa-2x text-center"> </i>
                        Guardar
                    </button>
            </tr>
            {!! Form::close() !!}
        @endforeach
        </tbody>
    </table>



@stop