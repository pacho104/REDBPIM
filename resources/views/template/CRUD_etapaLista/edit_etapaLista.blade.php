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
                    Edición de Etapa Etapa Para La Lista
                </h3>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {!! Form::model($etapaListaBan,['route' => ['etapaLista.update',$etapaListaBan->id],'method'=>'PUT'])!!}
                <fieldset>
                    <div class="form-group">
                        {!!Form::label('etapa_label','Nombre De La Etapa Para La Lista:',['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('nombre_etapaLista',$etapaListaBan->nom_etapa,['class'=>'form-control','placeholder'=>'Ingrese el nombre'])!!}
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Recursos:</label>
                        <div class="col-md-6">
                            {!! Form::select('recurso',$list_recu,$etapaListaBan->recurso_id_recurso,['class' => 'form-control'])!!}
                        </div>
                    </div>
                    <br><br>
                    {!!Form::button('Actualizar',['class'=>'btn btn-block btn-primary','data-toggle'=>'modal','data-target'=>'#myModal']) !!}

                    @include('template.partials.confirmar')

                </fieldset>
                {!! Form::close() !!}

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@stop