@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection

@section('content')

    @include('template.partials.logbar')


    <div class="row-fluid">
        <div class="container" id="admin">


            @include('template.partials.mensajes')


                <ul id="alignrightCreate" class="nav nav-tabs navbarfont navbar-right">
                <li><a href="{{route('salas.create')}}">
                        <i class="fa fa-plus"></i> &nbsp Crear Nueva Sala </a></li>
            </ul>
            {!!Form::model(Request::all(),['route'=>'salas.index','method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
            <div class="form-group">
                {!!Form::text('nom_sal',null,['class'=>'form-control','placeholder'=>'Sala'])!!}
            </div>
            <button type="submit" class="btn btn-default">Buscar</button>
            {!!Form::close()!!}

            <table class="table table-striped  table-bordered">
                <thead>
                <th class="col-md-4" align="center">Nombre de la Sala que Administras</th>
                <th class="col-md-1" align="center">Estado</th>
                <th class="col-md-3" align="center">Acciones</th>
                </thead>
                <tbody>



                @foreach($sala_chat as $sal)
                    <tr>

                        <td>{{$sal->nombre_sala_chat}}</td>

                        {!!Form::open(['url'=> ['esta',$sal->id],'method'=>'POST'])!!}
                        <td>@if($sal->estado_sala_chat=='0')

                                <div class="btn-group btn-toggle">
                                    {!! Form::submit('ON',['class'=>'btn btn-default'])!!}
                                    {!! Form::submit('OFF',['class'=>'btn btn-success','active'])!!}

                                </div>
                            @else

                                <div class="btn-group btn-toggle">
                                    {!! Form::submit('ON',['class'=>'btn btn-success','active'])!!}
                                    {!! Form::submit('OFF',['class'=>'btn btn-default'])!!}
                                </div>
                            @endif
                        </td>
                        {!!Form::close()!!}

                        <td>
                            <div class="btn-group-justified">
                                <a  href="salas/{{$sal->id}}/edit" class="btn btn-warning">EDITAR
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="msj/{{$sal->id}}" class="btn btn-primary">MENSAJES
                                </a>
                                <a data-toggle="modal" data-target="#ConfirmDelete-{{$sal->id}}" href="#ConfirmDelete-{{$sal->id}}"
                                   class="btn btn-danger">ELIMINAR
                                    <i class="fa fa-trash">
                                    </i>
                                </a>

                            </div>
                        </td>
                    </tr>
                @endforeach
                @foreach($sala_chat as $delete)
                    <div class="modal" id="ConfirmDelete-{{$delete->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    {!!Form::button('×',['class'=>'close','data-dismiss'=>'modal'])!!}
                                    <h4 class="modal-title">Confirmación</h4>
                                </div>
                                <div class="modal-body">
                                    <h6>¿Realmente desea eliminar el registro seleccionado?</h6>
                                </div>
                                <div class="modal-footer">
                                    {!!Form::open(['route'=> ['salas.destroy',$delete->id],'method'=>'DELETE','id'=>'form-delete'])!!}
                                        {!!Form::button('Cancelar',['class'=>'btn btn-default','data-dismiss'=>'modal'])!!}
                                        {!!Form::submit('ELIMINAR',['class'=>'btn btn-danger'])!!}
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div>
                    </div>
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