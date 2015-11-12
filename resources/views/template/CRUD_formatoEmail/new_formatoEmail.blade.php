@extends('template.main')
@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection
@section('content')

    @include('template.partials.logbar')

    <div class="row-fluid">

        @include('template.partials.error')

        <div class="container">
            <div class="jumbotrom">
                <h3 class="text-center">
                    Crear Nuevo Formato Email
                </h3>
            </div>
        </div>

        <br><br>

        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {!!Form::open(['route'=>'proceso.store','method'=>'POST'])!!}
                <fieldset>

                    <div class="form-group">
                        {!! Form::label('', 'Nombre Del Proceso:',['class'=>'col-md-4 control-label'])!!}
                        <div class="col-md-6">
                            {!!Form::text('nombre_proceso','',['class'=>'form-control','placeholder'=>'Ingrese el nombre
                            del proceso','value'=>'{{old("nombre_proceso")}}'])!!}
                        </div>
                    </div>
                    <br><br>

                    {!!Form::button('Registrar Proceso',['class'=>'btn btn-block
                    btn-primary','data-toggle'=>'modal','data-target'=>'#myModal']) !!}

                    @include('template.partials.confirmar_save')
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop