@extends('template.main')
@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection
@section('content')

    @include('template.partials.logbar_admin')

    <div class="row-fluid">
        @if (count($errors) > 0)
            <div id="dangercolor" class="alert alert-danger">
                <strong>Ups!</strong> Exiten problemas con los campos ingresados. <br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container">
            <div class="jumbotrom">
                <h3 class="text-center">
                    Edición de la biblioteca
                </h3>
            </div>
        </div>
        <br>

        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-11">
                {!! Form::open(['url' => 'admin/biblioteca/'.$biblioteca->id.'/refresh', 'autocomplete' => 'off']) !!}
                <fieldset>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Departamento al cuál aplica:</label>

                        <div class="col-md-9">
                            {!! Form::select('departamento',
                            ($list_dep),
                            $biblioteca->id_departamento,
                            ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>
                    <br><br>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Título de la biblioteca:</label>

                        <div class="col-md-10">
                            <input type="text" class="form-control" name="titulo_biblioteca"
                                   value="{{old('titulo_biblioteca',$biblioteca->titulo_biblioteca)}}">
                        </div>
                    </div>
                    <br><br>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Contenido de la biblioteca:</label>

                        <div class="col-md-10">
                        <textarea name="documento_biblioteca" value="{{old('documento_biblioteca')}}" id="editor"
                                  cols="30" rows="18"
                                  class="form-control">
                        {!!$biblioteca->documento_biblioteca!!}
						</textarea>
                        </div>
                    </div>
                    <br><br>

                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal">
                        Actualizar
                    </button>
                    <br><br>

                    <div id="myModal" class="modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                    </button>
                                    <h4 class="modal-title">Confirmación</h4>
                                </div>
                                <div class="modal-body">
                                    <h6>¿Realmente desea guardar los cambios realizados?</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#editor').trumbowyg();
    </script>
@stop