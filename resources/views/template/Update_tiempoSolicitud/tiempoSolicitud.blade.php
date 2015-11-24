@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection

@section('content')

    @include('template.partials.logbar')
    <h3 class="text-center">
        Listado de Solicitudes
    </h3>


    <div class="row-fluid">
        <div class="container" id="admin">

            @include('template.partials.mensajes')



            {!!Form::model(Request::all(),['route'=>'tiempoSolicitud.index','method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
                <div class="form-group">
                    {!!Form::text('nom_solicitud',null,['class'=>'form-control','placeholder'=>'Solicitud'])!!}
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
            {!!Form::close()!!}

            <table class="table table-striped  table-bordered">
                <thead>

                <th class="col-md-5" align="center">Nombre de la Solicitud</th>
                <th class="col-md-2" align="center">Tiempo Limite En Dias (Editable)</th>
                <th class="col-md-3" align="center">Acciones</th>
                </thead>
                <tbody>



                @foreach($tiempoSolicitudBan as $ti)

                    <tr>
                        <td align="justify">{{$ti->nom_solicitud}}</td>
                        <td align="center">
                        {!! Form::model($tiempoSolicitudBan,['route' => ['tiempoSolicitud.update',$ti->id],'method'=>'PUT'])!!}
                        <input type="number" class="form-control" name="tiempo"
                               placeholder="Ingrese los dias limites" value="{{$ti->tiempo}}" min="0">
                        </td>


                            <td>

                                <div class="btn-group-justified">

                                    {!!Form::submit('Actualizar',['class'=>'btn btn-block btn-warning'])!!}


                                </div>

                            </td>
                        {!! Form::close() !!}
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
        <div class="col-md-2"></div>
        <div class="container" align="center">
            {!!$tiempoSolicitudBan->appends(Request::only(['nom_solicitud']))->render()!!}
        </div>
    </div>



@stop