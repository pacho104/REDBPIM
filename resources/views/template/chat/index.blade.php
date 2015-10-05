@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection

@section('content')

    @include('template.partials.logbar')


    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">

    <section class="formInicio" id="connectFormDialog" >
        <h3  class="blue">BIENVENIDO!!!</h3>
        <form id="connectForm" onsubmit="return connectToChat();">
            <div class="form-group">
                <input disabled type="text" class="form-control" name="user.name"  placeholder="Ingrese Su Nombre" value="{{Auth::user()->nom_usuario." ".Auth::user()->ape_usuario}}">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="room.name" placeholder="Ingrese El Nombre De La Sala" value="{{$idSala}}">
            </div>
            <button type="submit" class="btn btn-success">Continuar</button>
            <a  href='/salasDis' class="btn btn-danger">Cancelar</a>
        </form>

    </section>

    <section id="messageDialog" class="form-control">


        <div class="container">
            <div class="row">
                <h5 class="blue">Usuarios En Linea En La Sala</h5>
                <div class="conversation-wrap col-lg-3">
                    <table class="table username" >
                        <tbody class="tbody1" id="lista" >

                        <tbody>
                    </table>
                </div>
                <div class="message-wrap col-lg-8" >
                    <div class="msg-wrap" id="tb1">
                        <div class="media msg " id="chatcontainer">
                            <div class="media-body col"  >
                                <table  class="table table-striped" >
                                    <tbody id="chatwindow">
                                    @foreach($mensajes as $mjs)
                                        <tr >
                                            <td ><small class="pull-right time"><i class="fa fa-clock-o"></i>{{$mjs->hora_mensaje}} -- {{$mjs->fecha_mensaje}}</small>
                                                <small class="pull-left username">{{$mjs->id_usuario}}</small><br>
                                                <p align="justify">{{$mjs->texto_mensaje}}</p></td>
                                            <span dir="auto" style="opacity: 0; position: absolute; overflow: scroll;"></span>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div id="mennsaje">
                        {!!Form::open(['id'=>'messageForm','onsubmit'=>'return sendChatMessage(event)'])!!}

                            <textarea  name="message" class="form-control" rows="3" placeholder="Escriba un mensaje aquí, y presione la tecla Enter para enviarlo" id="messagebox" onkeypress="return sendChatMessage(event)" ></textarea>

                            <a href='/salasDis' role="button">Salir de la Sala</a>
                        {!!Form::close()!!}
                    </div>
                </div>

            </div>
        </div>

    </section>


    <script type="text/javascript" src="../js/chat.js"></script>

@stop



