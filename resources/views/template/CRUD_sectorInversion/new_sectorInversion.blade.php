@extends('template.main')
@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection
@section('content')

    @include('template.partials.logbar')

    <div class="row-fluid">

        @include('template.partials.error')

        <div class="container">
            <div class="jumbotrom">
                <h3 class="text-center">
                    Crear Nuevo Sector de Inversion
                </h3>
            </div>
        </div>

        <br><br>

        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                {!!Form::open(['route'=>'sectorInversion.store','method'=>'POST'])!!}
                <fieldset>

                    <div class="form-group">
                        {!! Form::label('', 'Nombre Del Sector de Inversion:',['class'=>'col-md-4 control-label'])!!}
                        <div class="col-md-6">
                            {!!Form::textarea('nombre_sector','',['class'=>'form-control','placeholder'=>'Ingrese El Nombre Del Sector','value'=>'{{old("nombre_sector")}}'])!!}
                        </div>
                    </div>
                    <br><br>

                    {!!Form::button('Registrar Sector',['class'=>'btn btn-block btn-primary','data-toggle'=>'modal','data-target'=>'#myModal']) !!}

                    @include('template.partials.confirmar_save')
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop