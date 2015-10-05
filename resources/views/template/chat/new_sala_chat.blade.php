@extends('template.main')
@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection
@section('content')

    @include('template.partials.logbar')

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
                    Crear Nueva Sala de Chat
                </h3>
            </div>
        </div>
        <br><br>

        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {!!Form::open(['route'=>'salas.store','method'=>'POST'])!!}
                <fieldset>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Nombre De La Sala:</label>

                        <div class="col-md-6">

                            <input type="text" class="form-control" name="nombre_sala"
                                   placeholder="ingrese el nombre de la sala"
                                   value="{{ old('nombre_sala')}}">
                        </div>
                    </div>
                    <br><br>
                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal">Registrar Sala De Chat</button>
                    <div id="myModal" class="modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                    </button>
                                    <h4 class="modal-title">Confirmación</h4>
                                </div>
                                <div class="modal-body">
                                    <h6>¿Realmente desea guardar la sala de chat?</h6>
                                </div>
                                <div class="modal-footer">
                                    {!!Form::submit('Cancelar',['class'=>'btn btn-default','data-dismiss'=>'modal']) !!}
                                    {!!Form::submit('Registrar',['class'=>'btn btn-primary']) !!}

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