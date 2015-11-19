@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection

@section('content')

    @include('template.partials.logbar')

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" xmlns="http://www.w3.org/1999/html">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">


    @include('template.CRUD_listaChequeo.partials.mjsRequisito')

    <div class="container">
        <div class="row">
            <div class="table-responsive">



                @include('template.CRUD_listaChequeo.partials.requisitosAll')

                    <div class="col-lg-1">
                        <table class="table" >
                                <tr></tr><tr></tr>
                                <tr></tr><tr></tr>
                                <tr></tr><tr></tr>

                              <tr>
                                   <td>

                                       {!!Form::submit('AGREGAR >',['class'=>'btn btn-success col-md-12' ])!!}
                                       {!!Form::close()!!}
                                   </td>
                              </tr>

                              <tr>
                                  <td>
                                      {!!Form::submit('< QUITAR',['class'=>'btn btn-danger  col-md-12','id'=>'btn_eli', 'onclick'=>'sendReq(event)'])!!}
                                  </td>
                              </tr>

                        </table>
                    </div>
                    <div class="col-lg-1">
                    </div>
                @include('template.CRUD_listaChequeo.partials.requisitosLista')


            </div>


        </div>
    </div>

    <script type="text/javascript" src="{{asset('js/listaChequeo.js')}}"></script>

@stop
