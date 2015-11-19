@extends('template.main')
@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection
@section('content')

    @include('template.partials.logbar')

    <div class="row-fluid">

        @include('template.partials.error')
        @include('template.partials.mensajes')

        <div class="container">
            <div class="jumbotrom">
                <h3 class="text-center">
                    Crear Nueva Lista de Chequeo Para Municipio
                </h3>
            </div>
        </div>

        <br><br>

        <div class="container">
            <div class="col-md-3"></div>
            <div class="col-md-8">
                {!!Form::open(['url'=>'newLiMun','method'=>'POST','class'=>'form-inline'])!!}

                <div class="form-group col-md-8">
                    {!! Form::label('', 'Nombre De la Lista:',['class'=>'col-md-5 control-label'])!!}
                    {!!Form::text('nombre_lista','',['class'=>'col-md-6 form-control','placeholder'=>'Nombre','value'=>'{{old("nombre_lista")}}'])!!}
                </div><br><br><br>
                <div class="form-group col-md-8">
                    {!! Form::label('', 'Tipo Lista:',['class'=>'col-md-5 control-label'])!!}
                    {!! Form::select('tipo',(['0' => 'Seleccione el Tipo']+$tipo),null,['class' => 'col-md-6 form-control'])!!}
                </div><br><br><br>
                <div class="form-group col-md-8">
                    {!! Form::label('', 'Sector De Inversión:',['class'=>'col-md-5 control-label'])!!}
                    {!! Form::select('sector',(['0' => 'Seleccione el Sector']+$sector ),null,['class' => 'col-md-6 form-control'])!!}
                </div><br><br><br>

                <div class="form-group col-md-8">
                    {!! Form::label('', 'Etapa:',['class'=>'col-md-5 control-label'])!!}
                    {!! Form::select('etapa',(['0' => 'Seleccione la Etapa']+$etapa ),null,['class' => 'col-md-6 form-control'])!!}
                </div><br><br><br>

                <div class="form-group col-md-8">
                    {!! Form::label('', 'Proceso:',['class'=>'col-md-5 control-label'])!!}
                    {!! Form::select('proceso',(['0' => 'Seleccione el Proceso']+$proceso ),null,['class' => 'col-md-6 form-control'])!!}

                </div><br><br><br>

                <div class="form-group col-md-8">
                    {!!Form::button('Registrar Lista',['class'=>'col-md-6 btn btn-block btn-primary','data-toggle'=>'modal','data-target'=>'#myModal']) !!}
                </div>

                @include('template.partials.confirmar_save')

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop