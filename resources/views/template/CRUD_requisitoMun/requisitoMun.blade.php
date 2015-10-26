@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection

@section('content')

    @include('template.partials.logbar')

    <h3 class="text-center">
        Requisitos Para Listas de Chequeo Municipal
    </h3>

    <div class="row-fluid">
        <div class="container" id="admin">

            @include('template.partials.mensajes')


            <ul id="alignrightCreate" class="nav nav-tabs navbarfont navbar-right">
                <li><a href="{{url('creaMun')}}">
                        <i class="fa fa-plus"></i> &nbsp Crear Nuevo Requisito </a></li>
            </ul>
            {!!Form::model(Request::all(),['url'=>'reqMun','method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
            <div class="form-group">
                {!!Form::text('nom_requisito',null,['class'=>'form-control','placeholder'=>'Requisito'])!!}
            </div>
            <button type="submit" class="btn btn-default">Buscar</button>
            {!!Form::close()!!}

            <table class="table table-striped  table-bordered">
                <thead>

                <th class="col-md-4" align="center">Nombre del Requisito</th>
                <th class="col-sm-1" align="center">Obligatorio</th>
                <th class="col-md-3" align="center">Acciones</th>
                </thead>
                <tbody>



                @foreach($requisitoBan as $re)
                    <tr>
                        <td align="justify">{{$re->nom_requisito}}</td>

                        <td align="center">{!!Form::checkbox('cheObli',null,$re->obligatorio,['id'=>'seleObli','disabled'=>'disabled'])!!}</td>

                        <td>
                            <div class="btn-group-justified">
                                <a  href="editMunReq/{{$re->id}}" class="btn btn-warning">EDITAR
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a data-toggle="modal" data-target="#ConfirmDelete-{{$re->id}}" href="#ConfirmDelete-{{$re->id}}"
                                   class="btn btn-danger">ELIMINAR
                                    <i class="fa fa-trash">
                                    </i>
                                </a>

                            </div>
                        </td>
                    </tr>
                @endforeach
                @foreach($requisitoBan as $delete)
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
                                    {!!Form::open(['route'=> ['requisito.destroy',$delete->id],'method'=>'DELETE','id'=>'form-delete'])!!}
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
            {!!$requisitoBan->appends(Request::only(['nom_requisito']))->render()!!}
        </div>
    </div>



@stop