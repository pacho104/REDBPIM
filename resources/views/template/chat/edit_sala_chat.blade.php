@extends('template.main')
@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection
@section('content')

    @include('template.partials.logbar')

    <div class="row-fluid">
        @include('template.partials.error')
        <div class="container">
            <div class="jumbotrom">
                <h3 class="text-center">
                    Edición de la Sala de Chat
                </h3>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {!! Form::model($sala_chat,['route' => ['salas.update',$sala_chat->id],'method'=>'PUT'])!!}
                <fieldset>
                        <div class="form-group">
                            {!!Form::label('sala_chat_label','Nombre de la Sala:',['class'=>'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!!Form::text('nombre_sala',$sala_chat->nombre_sala_chat,['class'=>'form-control','placeholder'=>'Ingrese el nombre'])!!}
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