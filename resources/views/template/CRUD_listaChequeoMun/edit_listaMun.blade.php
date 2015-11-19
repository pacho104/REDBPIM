@extends('template.main')
@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection
@section('content')

    @include('template.partials.logbar')

    <div class="row-fluid">
        @include('template.partials.error')
        <div class="container">
            <div class="jumbotrom">
                <h3 class="text-center">
                    Edición Lista de Chequeo Para Municipio
                </h3>
            </div>
        </div>
        <br><br>
        <div class="container">
            <div class="col-md-3"></div>
            <div class="col-md-8">
                {!! Form::model($listaBan,['route' => ['lista.update',$listaBan->id],'method'=>'PUT','class'=>'form-inline'])!!}

                <div class="form-group col-md-8">
                    {!! Form::label('', 'Nombre De la Lista:',['class'=>'col-md-5 control-label'])!!}
                    {!!Form::text('nombre_lista',$listaBan->nom_lista,['class'=>'col-md-6 form-control','placeholder'=>'Nombre'])!!}
                </div><br><br><br>
                <div class="form-group col-md-8">
                    {!! Form::label('', 'Tipo Lista:',['class'=>'col-md-5 control-label'])!!}
                    {!! Form::select('tipo',$tipo,$listaBan->tipo_lista,['class' => 'col-md-6 form-control'])!!}
                </div><br><br><br>
                <div class="form-group col-md-8">
                    {!! Form::label('', 'Sector De Inversión:',['class'=>'col-md-5 control-label'])!!}
                    {!! Form::select('sector',$sector,$listaBan->sector_inversion_id_sector,['class' => 'col-md-6 form-control'])!!}
                </div><br><br><br>

                <div class="form-group col-md-8">
                    {!! Form::label('', 'Etapa:',['class'=>'col-md-5 control-label'])!!}
                    {!! Form::select('etapa',$etapa,$listaBan->etapa_lista_id_etapa,['class' => 'col-md-6 form-control'])!!}
                </div><br><br><br>

                <div class="form-group col-md-8">
                    {!! Form::label('', 'Proceso:',['class'=>'col-md-5 control-label'])!!}
                    {!! Form::select('proceso',$proceso,$listaBan->proceso_id_proceso,['class' => 'col-md-6 form-control'])!!}

                </div><br><br><br>
                <div class="form-group col-md-8">
                    {!!Form::button('Actualizar',['class'=>'btn btn-block btn-primary','data-toggle'=>'modal','data-target'=>'#myModal']) !!}
                </div>
                @include('template.partials.confirmar')


                {!! Form::close() !!}

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@stop