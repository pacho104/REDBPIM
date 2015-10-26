@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection

@section('content')

    @include('template.partials.logbar')

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" xmlns="http://www.w3.org/1999/html">
    <link rel="stylesheet" href="../css/style.css">


    <div class="container">
        <div class="row">
            <div class="table-responsive">


                @if(\Session::has('message'))
                    <div class="alert alert-dismissible alert-success fontbig">
                        {!!Form::submit('×',['class'=>'close','data-dismiss'=>'alert'])!!}
                        <strong>{{\Session::get('message')}}</strong>
                    </div>
                @endif


                 {!!Form::model(Request::all(),['route'=>'mensaje.destroy','method'=>'DELETE','role'=>'form']) !!}


                    <li class="nav nav-tabs navbarfont navbar-right"><br>&nbsp&nbsp{!!Form::submit('ELIMINAR SELECCION',['class'=>'btn btn-danger'])!!} &nbsp&nbsp&nbsp</li><br>

                    <li class="nav nav-tabs navbarfont navbar-right">&nbsp {!!Form::checkbox('name',null,null,['id'=>'seleTodo','onclick'=>'seleccionar()'])!!}Seleccionar Todo</li>


                        <table class="table">
                            <thead>
                            <th class="col-md-6 " >MENSAJE</th>
                            <th class="col-md-1 " >SELECCIONAR</th>
                            </thead>
                                <tbody class="messages-container" id="chatwindowMensa">

                                    @foreach($mensajes as $mjs)
                                        <tr>
                                                <td class="col-md-6"><small class="pull-right time"><i class="fa fa-clock-o"></i>{{$mjs->hora_mensaje}} -- {{$mjs->fecha_mensaje}}</small>
                                                    <small class="pull-left username">{{$mjs->id_usuario}}</small><br>
                                                    <p align="justify">{{$mjs->texto_mensaje}}</p>

                                                 </td>

                                                 <td class="col-md-1" id="check" align="center">{!!Form::checkbox('che[]',$mjs->id,null,['id'=>'seleUno'])!!}

                                                 </td>
                                        </tr>
                                     @endforeach
                                </tbody>
                            </table>
                    </div>
                    {!!Form::close()!!}
        </div>
    </div>

    <script type="text/javascript" src="../js/chat.js"></script>

@stop



