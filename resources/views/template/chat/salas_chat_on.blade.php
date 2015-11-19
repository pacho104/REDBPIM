@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection

@section('content')

    @include('template.partials.logbar')



    <div class="row-fluid">
        <div class="container" id="admin">

            @include('template.partials.mensajes')


            {!!Form::open(['url'=>'salasDis','method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
                <div class="form-group">
                    {!!Form::text('nom_sal',null,['class'=>'form-control','placeholder'=>'Sala'])!!}
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
            {!!Form::close()!!}

            <table class="table table-striped  table-bordered">
                <thead>
                <th class="col-md-5">Salas Disponibles</th>
                <th class="col-md-1">Acciones</th>
                </thead>
                <tbody>


                @foreach($sala_chat as $sal)
                        <tr>

                            <td>{{$sal->nombre_sala_chat}}</td>
                            {!!Form::open(['url'=> ['sala',$sal->id],'method'=>'GET'])!!}
                            <td>
                                {!! Form::submit('INGRESAR',['class'=>'btn btn-primary'])!!}
                            </td>
                            {!!Form::close()!!}
                        </tr>
                    @endforeach


                </tbody>
            </table>

        </div>
        <div class="col-md-2"></div>
        <div class="container" align="center">
            {!!$sala_chat->appends(Request::only(['nom_sal']))->render()!!}
        </div>
    </div>



@stop