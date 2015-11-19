@extends('template.main')
@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection
@section('content')

    @include('template.partials.logbar')

    <div class="row-fluid">

        @include('template.partials.error')



        <div class="container">
            <div class="jumbotrom">
                <h3 class="text-center">
                    Crear Nuevo Requisito Para Lista de Chequeo Municipal
                </h3>
            </div>
        </div>

        <br><br>

        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {!!Form::open(['url'=>'newMun','method'=>'POST'])!!}
                <fieldset>

                    <div class="form-group">
                        {!! Form::label('', 'Nombre Del Requisito:',['class'=>'col-md-4 control-label'])!!}
                        <div class="col-md-6">
                            {!!Form::textarea('nombre_requisito','',['class'=>'form-control','placeholder'=>'Ingrese el nombre del requisito','value'=>'{{old("nombre_requisito")}}'])!!}
                            <br>
                            <label>
                                {!!Form::checkbox('cheObli',null,null,['id'=>'seleObli'])!!}
                                OBLIGATORIO</label>
                            <br> <br>
                        </div>
                    </div>
                    <br><br>

                    {!!Form::button('Registrar Requisito',['class'=>'btn btn-block btn-primary','data-toggle'=>'modal','data-target'=>'#myModal']) !!}

                    @include('template.partials.confirmar_save')
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop