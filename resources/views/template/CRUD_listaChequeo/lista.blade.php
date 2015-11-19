@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection

@section('content')

    @include('template.partials.logbar')

    <h3 class="text-center">
        Listas de Chequeo De Toda La Red
    </h3>
    <div class="row-fluid">
        <div class="container" id="admin">

            @include('template.partials.mensajes')

            <ul id="alignrightCreate" class="nav nav-tabs navbarfont navbar-right">
                <li><a href="{{route('lista.create')}}">
                        <i class="fa fa-plus"></i> &nbsp Crear Nueva Lista de Chequeo </a></li>
            </ul>
            {!!Form::model(Request::all(),['route'=>'lista.index','method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
            <div class="form-group">
                {!!Form::text('nom_lista',null,['class'=>'form-control','placeholder'=>'Lista'])!!}
            </div>
            <button type="submit" class="btn btn-default">Buscar</button>
            {!!Form::close()!!}

            <table class="table table-striped  table-bordered">
                <thead>

                <th class="col-md-3" align="center">Nombre de la Lista</th>
                <th class="col-md-1" align="center">Tipo</th>
                <th class="col-md-1" align="center">Sector</th>
                <th class="col-md-1" align="center">Etapa</th>
                <th class="col-md-1" align="center">Recursos</th>
                <th class="col-md-1" align="center">Proceso</th>


                <th class="col-md-4" align="center">Acciones</th>
                </thead>
                <tbody>

                @foreach($listaBan as $lis)
                    <tr>
                        <td align="justify">{{$lis->nom_lista}}</td>
                        <td align="justify">{{$lis->tipo->nom_tipo}}  </td>
                        <td align="justify">{{$lis->sector->nom_sector_inversion}}</td>
                        <td align="justify">{{$lis->etapa->nom_etapa}}</td>
                        <td align="justify">{{$lis->etapa->recursos->nom_recurso}}</td>
                        <td align="justify">{{$lis->proceso->nom_proceso}}</td>


                        <td>
                            <div class="btn-group-justified">
                                <a  href="{{route('lista.edit',"$lis->id")}}" class="btn btn-warning">EDITAR
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a  href="{{route('req',"$lis->id")}}" class="btn btn-primary">REQUISITOS
                                    <i class="fa fa-list-alt"></i>
                                </a>
                                <a data-toggle="modal" data-target="#ConfirmDelete-{{$lis->id}}" href="#ConfirmDelete-{{$lis->id}}"
                                   class="btn btn-danger">ELIMINAR
                                    <i class="fa fa-trash">
                                    </i>
                                </a>

                            </div>

                        </td>
                    </tr>
                @endforeach
                @foreach($listaBan as $delete)
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
                                    {!!Form::open(['route'=> ['lista.destroy',$delete->id],'method'=>'DELETE','id'=>'form-delete'])!!}
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
            {!!$listaBan->appends(Request::only(['nom_lista']))->render()!!}
        </div>
    </div>



@stop