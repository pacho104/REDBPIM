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
                    Editar Formato Para Evidencias
                </h3>
            </div>
        </div>

        <br><br>

        <div class="container">
            <div class="col-md-1"></div>
            <div class="table-responsive">

                <div>


                    {!! Form::model($formatoEBan,['route' => ['formatoEvidencia.update',$formatoEBan->id],'method'=>'PUT','class'=>'form-inline','enctype'=>'multipart/form-data'])!!}


                    {!! Form::label('', 'Nombre Del Formato:',['class'=>'col-md-2 control-label'])!!}
                    {!!Form::text('nombre_formato',$formatoEBan->nom_formato,['class'=>'caja-nombre','placeholder'=>'Nombre'])!!}
                    <br><br><br>

                    {!! Form::label('', 'Logo:',['class'=>'col-md-2 control-label'])!!}

                    <table>
                        <tbody id="tbody1">
                           <tr id="tr1">
                                <td>
                                  <img src = "{{url($url)}}" name="img" class="img-thumbnail">
                                </td>
                                <td class="col-lg-1">
                                    {!!Form::button('QUITAR LOGO',['class'=>'btn btn-warning','id'=>'btn_eliLogo','onclick'=>'sendLogo(event)'])!!}
                                </td>
                                <td>
                                    <input type="file" accept="image/*" name="logo"/>
                                </td>
                           </tr>
                        </tbody>
                    </table>
                    <br><br>

                    {!! Form::label('', 'Encabezado/Título:',['class'=>'col-md-2 control-label'])!!}
                    {!!Form::textarea('encabezado_formato',$formatoEBan->encabezado_formato,['class'=>'caja-nombreEncabezado', 'placeholder'=>'Encabezado/Título del Formato'])!!}
                    <br><br><br>

                    {!! Form::label('', 'Cuerpo del Formato:',['class'=>'col-md-2 control-label'])!!}
                    {!!Form::textarea('cuerpo_formato',$formatoEBan->cuerpo_formato,['class'=>'caja-nombreCuerpo','placeholder'=>'Cuerpo del Formato'])!!}
                    <br><br><br>

                </div>
                <div>
                    {!!Form::button('Actualizar',['class'=>'btn btn-block btn-primary','data-toggle'=>'modal','data-target'=>'#myModal']) !!}
                    <br><br><br> <br><br><br>
                </div>
                @include('template.partials.confirmar')

                {!! Form::close() !!}

                {!!Form::open(['url'=>['elLogo',$formatoEBan->id],'method'=>'GET','role'=>'form','name'=>'reqFromLogo']) !!}
                {!! Form::close() !!}

            </div>
        </div>
        <script type="text/javascript" src="{{asset('js/listaChequeo.js')}}"></script>
    </div>
@stop