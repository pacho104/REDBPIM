@extends('template.main')
@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection
@section('content')

    @include('template.partials.logbar')

    <link rel="stylesheet" href="{{url('css/tablaEditarFormato.css')}}">


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
                   <table>
                   {!! Form::label('', 'Nombre Del Formato:',['class'=>'col-md-2 control-label'])!!}
                       <td class="col-lg-4">
                   {!!Form::text('nombre_formato','',['class'=>'caja-nombre','placeholder'=>'Nombre','value'=>'{{old("nombre_formatoE")}}'])!!}
                       </td>
                   </table>
                   <br><br><br><br>

                   <table>
                   {!! Form::label('', 'Logo:',['class'=>'col-md-2 control-label'])!!}
                       <td class="col-lg-4">
                   <input type="file" accept="image/*" name="logo"/>
                       </td>
                       </table>
                   <br><br>

                   <table>
                       {!! Form::label('', 'Encabezado/Título:',['class'=>'col-md-2 control-label'])!!}
                       <td class="col-lg-4">
                       {!!Form::textarea('encabezado_formato','',['class'=>'caja-nombreEncabezado ckeditor', 'placeholder'=>'Encabezado/Título del Formato'])!!}
                       </td>
                   </table>
                   <br><br><br>
                   <table>
                       {!! Form::label('', 'Cuerpo del Formato:',['class'=>'col-md-2 control-label'])!!}
                       <td class="col-lg-4">
                       {!!Form::textarea('cuerpo_formato','',['class'=>'caja-nombreCuerpo ckeditor','placeholder'=>'Cuerpo del Formato'])!!}
                       </td>
                   </table>
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
        <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
    </div>


@stop