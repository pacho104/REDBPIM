@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection

@section('content')

    @include('template.partials.logbar')


    <div class="row-fluid">
        <div class="container" id="admin">

            @include('template.partials.mensajes')


            <ul id="alignrightCreate" class="nav nav-tabs navbarfont navbar-right">
                <li><a href="{{route('recurso.create')}}">
                        <i class="fa fa-plus"></i> &nbsp Crear Nuevo Recurso </a></li>
            </ul>
            {!!Form::model(Request::all(),['route'=>'recurso.index','method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
            <div class="form-group">
                {!!Form::text('nom_recurso',null,['class'=>'form-control','placeholder'=>'Recurso'])!!}
            </div>
            <button type="submit" class="btn btn-default">Buscar</button>
            {!!Form::close()!!}

            <table class="table table-striped  table-bordered">
                <thead>

                <th class="col-md-4" align="center">Nombre del Recurso</th>
                <th class="col-md-3" align="center">Acciones</th>
                </thead>
                <tbody>


                @foreach($recursoBan as $re)
                    <tr>
                        <td align="justify">{{$re->nom_recurso}}</td>

                        <td>
                            <div class="btn-group-justified">
                                <a  href="{{route('recurso.edit',"$re->id")}}" class="btn btn-warning">EDITAR
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
                @foreach($recursoBan as $delete)
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
                                    {!!Form::open(['route'=> ['recurso.destroy',$delete->id],'method'=>'DELETE','id'=>'form-delete'])!!}
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
            {!!$recursoBan->appends(Request::only(['nom_recurso']))->render()!!}
        </div>
    </div>

@stop