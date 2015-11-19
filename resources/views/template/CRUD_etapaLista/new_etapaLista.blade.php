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
                    Crear Nueva Etapa Para La Lista
                </h3>
            </div>
        </div>

        <br><br>

        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {!!Form::open(['route'=>'etapaLista.store','method'=>'POST'])!!}
                <fieldset>

                    <div class="form-group">
                        {!! Form::label('', 'Nombre De La Etapa Para La Lista:',['class'=>'col-md-4 control-label'])!!}
                        <div class="col-md-6">
                            {!!Form::text('nombre_etapaLista','',['class'=>'form-control','placeholder'=>'Ingrese el nombre de la etapa para la lista','value'=>'{{old("nombre_etapaLista")}}'])!!}
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Recursos:</label>
                        <div class="col-md-6">
                            {!! Form::select('recurso',(['0' => 'Seleccione el Recurso'] + $list_recu),null,['class' => 'form-control'])!!}
                        </div>
                    </div>
                    <br><br>
                    {!!Form::button('Registrar Etapa Para La Lista',['class'=>'btn btn-block btn-primary','data-toggle'=>'modal','data-target'=>'#myModal']) !!}

                    @include('template.partials.confirmar_save')
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop