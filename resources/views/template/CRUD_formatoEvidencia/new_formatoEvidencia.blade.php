@extends('template.main')
@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection
@section('content')

    @include('template.partials.logbar')

    <link rel="stylesheet" href="{{asset('css/style.css')}}">


    <div class="row-fluid">

        @include('template.partials.error')
        @include('template.partials.mensajes')

        <div class="container">
            <div class="jumbotrom">
                <h3 class="text-center">
                    Crear Nuevo Formato Para Evidencias
                </h3>
            </div>
        </div>

        <br><br>

        <div class="container">
            <div class="col-md-1"></div>
                <div class="table-responsive">

               <div>
                   {!!Form::open(['route'=>'formatoEvidencia.store','method'=>'POST','class'=>'form-inline','enctype'=>'multipart/form-data'])!!}

                   {!! Form::label('', 'Nombre Del Formato:',['class'=>'col-md-2 control-label'])!!}
                   {!!Form::text('nombre_formato','',['class'=>'caja-nombre','placeholder'=>'Nombre','value'=>'{{old("nombre_formatoE")}}'])!!}
                   <br><br><br>

                   {!! Form::label('', 'Logo:',['class'=>'col-md-2 control-label'])!!}
                   <input type="file" accept="image/*" name="logo"/>
                   <br><br><br>

                       {!! Form::label('', 'Encabezado/Título:',['class'=>'col-md-2 control-label'])!!}
                       {!!Form::textarea('encabezado_formato','',['class'=>'caja-nombreEncabezado', 'placeholder'=>'Encabezado/Título del Formato'])!!}
                   <br><br><br>

                       {!! Form::label('', 'Cuerpo del Formato:',['class'=>'col-md-2 control-label'])!!}
                       {!!Form::textarea('cuerpo_formato','',['class'=>'caja-nombreCuerpo','placeholder'=>'Cuerpo del Formato'])!!}
                   <br><br><br>

                </div>
                    <div>
                        {!!Form::button('Registrar Formato',['class'=>'btn btn-block btn-primary','align'=>'center' ,'data-toggle'=>'modal','data-target'=>'#myModal']) !!}
                        <br><br><br> <br><br><br>
                    </div>

                @include('template.partials.confirmar_save')


                {!! Form::close() !!}

               </div>
        </div>

    </div>
@stop