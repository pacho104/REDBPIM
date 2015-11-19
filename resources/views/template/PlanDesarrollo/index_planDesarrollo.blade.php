@extends('template.main')

@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection

@section('content')

    @include('template.partials.logbar_admin')

    <div class="row-fluid">
        <div class="container" id="admin">

            @if(\Session::has('alert'))
                <div class="alert alert-dismissible alert-success fontbig">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{Session::get('alert')}}</strong>
                </div>
            @endif

            @if(\Session::has('alertExiste'))
                <div class="alert alert-dismissible alert-warning fontbig">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{Session::get('alertExiste')}}</strong>
                </div>
            @endif

            @if(\Session::has('ValidationDelete'))
                <div id="dangercolor" class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fa fa-exclamation-triangle"></i>
                    {{Session::get('ValidationDelete')}}
                </div>
             @endif

            <div class="container">
                <ul id="alignrightCreate" class="nav nav-tabs navbarfont navbar-right">
                    <li><a href="{{route('new_plan_municipal')}}">
                    <i class="fa fa-plus"></i> &nbsp Crear nuevo plan de desarrollo </a></li>
                </ul>
            </div>
            <br>

            @foreach($plan_desarrollo as $plan_de_desarrollo)
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Plan de Desarrollo Municipal</h3>
                    </div>

                    <div class="panel-body">
                        <h5 class="title">Plan de desarrollo </h5>
                        <table class="table table-striped  table-bordered">
                            <thead>
                            <th class="col-lg-2">código plan de desarrollo</th>
                            <th class="col-md-4"> nombre plan de desarrollo </th>
                            <th class="col-md-4"> Municipio </th>
                            <th class=""> Acciones </th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$plan_de_desarrollo->codigo_plan}}</td>
                                    <td>{{$plan_de_desarrollo->nombre_plan}}</td>
                                    <td>{{$plan_de_desarrollo->nom_municipio}}</td>
                                    <td>
                                        <div class="btn-group-justified">
                                            <a href="plan_desarrollo/{{$plan_de_desarrollo->id}}/editar" class="btn btn-warning"><i class="fa fa-edit"> </i></a>
                                            <a data-toggle="modal" data-target="#ConfirmDelete-{{$plan_de_desarrollo->id}}"
                                               href="#ConfirmDelete-{{$plan_de_desarrollo->id}}"
                                               class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>

                                    <div class="modal" id="ConfirmDelete-{{$plan_de_desarrollo->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Confirmación</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>¿Realmente desea eliminar el registro seleccionado?</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        <a href="plan_desarrollo/{{$plan_de_desarrollo->id}}/eliminar" class="btn btn-danger">Eliminar
                                                            Registro</a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                        $eje = \DB::table('eje_estrategico')
                                ->join('plan_de_desarrollo','eje_estrategico.id_plan_de_desarrollo','=','plan_de_desarrollo.id')
                                ->select('eje_estrategico.*')
                                ->where('eje_estrategico.id_plan_de_desarrollo','=',$plan_de_desarrollo->id)
                                ->get();

                        $id_eje = array_map(function ($get_id_eje){return $get_id_eje->id;}, $eje);

                        ?>

                        <h5 class="title">Eje estratégico
                            <ul id="alignrightPlanDesarrollo" class="nav nav-pills navbarfont navbar-right">
                                <li><a onclick="{{\Session::put('id_plan',$plan_de_desarrollo->id)}}" href="{{route('new_eje_estrategico')}}">
                                    <i class="fa fa-plus-square"></i> &nbsp crear nuevo eje estratégico </a></li>
                            </ul>
                        </h5>
                        <table class="table table-striped  table-bordered">
                            <thead>
                            <th class="col-lg-2">código eje estratégico</th>
                            <th class="col-md-4"> nombre eje estratégico </th>
                            <th class="col-md-4"> plan de desarrollo </th>
                            <th class=""> Acciones </th>
                            </thead>
                            <tbody>
                              @foreach($eje as $eje_estrategico)
                                 <tr>
                                    <td>{{$eje_estrategico->codigo_eje}}</td>
                                    <td>{{$eje_estrategico->nombre_eje}}</td>
                                    <td>{{$plan_de_desarrollo->nombre_plan}}</td>
                                    <td>
                                        <div class="btn-group-justified">
                                            <a href="plan_desarrollo/eje/{{$eje_estrategico->id}}/editar" class="btn btn-warning"><i class="fa fa-edit"> </i></a>
                                            <a data-toggle="modal" data-target="#ConfirmDeleteEje-{{$eje_estrategico->id}}"
                                               href="#ConfirmDeleteEje-{{$eje_estrategico->id}}"
                                               class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>

                                     <div class="modal" id="ConfirmDeleteEje-{{$eje_estrategico->id}}">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                     <h4 class="modal-title">Confirmación</h4>
                                                 </div>
                                                 <div class="modal-body">
                                                     <h6>¿Realmente desea eliminar el registro seleccionado?</h6>
                                                 </div>
                                                 <div class="modal-footer">
                                                     <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                     <a href="plan_desarrollo/eje/{{$eje_estrategico->id}}/eliminar" class="btn btn-danger">Eliminar Registro</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </tr>
                               @endforeach
                            </tbody>
                        </table>


                        <?php
                        $program = \DB::table('programa')
                                    ->join('eje_estrategico','programa.id_eje_estrategico','=','eje_estrategico.id')
                                    ->select('programa.*','eje_estrategico.nombre_eje')
                                    ->whereIn('programa.id_eje_estrategico',$id_eje)
                                    ->get();

                        $id_programa = array_map(function ($get_id_program){return $get_id_program->id;}, $program);
                        ?>

                        <h5 class="title">Programas
                            <ul id="alignrightPlanDesarrollo" class="nav nav-pills navbarfont navbar-right">
                                <li><a onclick="{{\Session::put('id_plan',$plan_de_desarrollo->id)}}" href="{{route('new_programa')}}">
                                    <i class="fa fa-plus-square"></i> &nbsp crear nuevo programa </a></li>
                            </ul>
                        </h5>
                        <table class="table table-striped  table-bordered">
                            <thead>
                            <th class="col-lg-2">código programa</th>
                            <th class="col-md-4"> nombre programa </th>
                            <th class="col-md-4"> eje estratégico </th>
                            <th class=""> Acciones </th>
                            </thead>
                            <tbody>
                             @foreach($program as $programa)
                                <tr>
                                    <td>{{$programa->codigo_programa}}</td>
                                    <td>{{$programa->nombre_programa}}</td>
                                    <td>{{$programa->nombre_eje}}</td>
                                    <td>
                                        <div class="btn-group-justified">
                                            <a href="plan_desarrollo/programa/{{$programa->id}}/editar" class="btn btn-warning"><i class="fa fa-edit"> </i></a>
                                            <a data-toggle="modal" data-target="#ConfirmDeletePrograma-{{$programa->id}}"
                                               href="#ConfirmDeletePrograma-{{$programa->id}}"
                                               class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                    <div class="modal" id="ConfirmDeletePrograma-{{$programa->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title">Confirmación</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h6>¿Realmente desea eliminar el registro seleccionado?</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                    <a href="plan_desarrollo/programa/{{$programa->id}}/eliminar" class="btn btn-danger">Eliminar Registro</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>

                        <?php
                        $subprogram = \DB::table('sub_programa')
                                      ->join('programa','sub_programa.id_programa','=','programa.id')
                                      ->select('sub_programa.*','programa.nombre_programa')
                                      ->whereIn('sub_programa.id_programa',$id_programa)
                                      ->get();

                        $id_sub_programa = array_map(function ($get_id_subprogram){return $get_id_subprogram->id;}, $subprogram);
                        ?>

                        <h5 class="title">Sub-Programas
                            <ul id="alignrightPlanDesarrollo" class="nav nav-pills navbarfont navbar-right">
                                <li><a onclick="{{\Session::put('id_plan',$plan_de_desarrollo->id)}}" href="{{route('new_subPrograma')}}">
                                        <i class="fa fa-plus-square"></i> &nbsp crear nuevo subprograma </a></li>
                            </ul>
                        </h5>
                        <table class="table table-striped  table-bordered">
                            <thead>
                            <th class="col-lg-2">código subprograma</th>
                            <th class="col-md-4"> nombre subprograma </th>
                            <th class="col-md-4"> Programa </th>
                            <th class=""> Acciones </th>
                            </thead>
                            <tbody>
                            @foreach($subprogram as $subprograma)
                                <tr>
                                    <td>{{$subprograma->codigo_sub_programa}}</td>
                                    <td>{{$subprograma->nombre_sub_programa}}</td>
                                    <td>{{$subprograma->nombre_programa}}</td>
                                    <td>
                                        <div class="btn-group-justified">
                                            <a href="plan_desarrollo/subPrograma/{{$subprograma->id}}/editar" class="btn btn-warning"><i class="fa fa-edit"> </i></a>
                                            <a data-toggle="modal" data-target="#ConfirmDeleteSubPrograma-{{$subprograma->id}}"
                                               href="#ConfirmDeleteSubPrograma-{{$subprograma->id}}"
                                               class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                    <div class="modal" id="ConfirmDeleteSubPrograma-{{$subprograma->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title">Confirmación</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h6>¿Realmente desea eliminar el registro seleccionado?</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                    <a href="plan_desarrollo/subPrograma/{{$subprograma->id}}/eliminar" class="btn btn-danger">Eliminar Registro</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>

                        <?php
                        $metaProgram = \DB::table('meta')
                                        ->join('meta_programas','meta_programas.id_meta','=','meta.id')
                                        ->join('programa','meta_programas.id_programa','=','programa.id')
                                        ->select('meta.*','programa.nombre_programa')
                                        ->whereIn('meta_programas.id_programa',$id_programa)
                                        ->get();

                        $metaSubProgram = \DB::table('meta')
                                            ->join('meta_subProgramas','meta_subProgramas.id_meta','=','meta.id')
                                            ->join('sub_programa','meta_subProgramas.id_sub_programa','=','sub_programa.id')
                                            ->select('meta.*','sub_programa.nombre_sub_programa')
                                            ->whereIn('meta_subProgramas.id_sub_programa',$id_sub_programa)
                                            ->get();
                        ?>

                        <h5 class="title">Metas
                            <ul id="alignrightPlanDesarrollo" class="nav nav-pills navbarfont navbar-right">
                                <li><a onclick="{{\Session::put('id_programa',$id_programa) }}"
                                    href="{{route('new_meta')}}">  <i class="fa fa-plus-square"></i> &nbsp crear nueva meta </a></li>
                            </ul>
                        </h5>
                        <table class="table table-striped  table-bordered">
                            <thead>
                            <th class="col-lg-3">nombre de la meta</th>
                            <th class="col-md-3"> tipo de meta </th>
                            <th class="col-md-1"> valor meta </th>
                            <th class="col-md-3"> programa-subprograma </th>
                            <th class=""> Acciones </th>
                            </thead>
                            <tbody>
                            @foreach($metaProgram as $metaPrograma)
                                <tr>
                                    <td>{{$metaPrograma->nombre_meta}}</td>
                                    <td>{{$metaPrograma->tipo_meta}}</td>
                                    <td>{{$metaPrograma->valor_meta}}</td>
                                    <td>{{$metaPrograma->nombre_programa}}</td>
                                    <td>
                                        <div class="btn-group-justified">
                                            <a href="plan_desarrollo/meta/programa/{{$metaPrograma->id}}/editar" class="btn btn-warning"><i class="fa fa-edit"> </i></a>
                                            <a data-toggle="modal" data-target="#ConfirmDeleteMetaPrograma-{{$metaPrograma->id}}"
                                               href="#ConfirmDeleteMetaPrograma-{{$metaPrograma->id}}"
                                               class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                    <div class="modal" id="ConfirmDeleteMetaPrograma-{{$metaPrograma->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title">Confirmación</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h6>¿Realmente desea eliminar el registro seleccionado?</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                    <a href="plan_desarrollo/meta/{{$metaPrograma->id}}/eliminar" class="btn btn-danger">Eliminar Registro</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                            @foreach($metaSubProgram as $metaSubPrograma)
                                <tr>
                                    <td>{{$metaSubPrograma->nombre_meta}}</td>
                                    <td>{{$metaSubPrograma->tipo_meta}}</td>
                                    <td>{{$metaSubPrograma->valor_meta}}</td>
                                    <td>{{$metaSubPrograma->nombre_sub_programa}}</td>
                                    <td>
                                        <div class="btn-group-justified">
                                            <a href="plan_desarrollo/meta/subPrograma/{{$metaSubPrograma->id}}/editar" class="btn btn-warning"><i class="fa fa-edit"> </i></a>
                                            <a data-toggle="modal" data-target="#ConfirmDeleteMetaSubPrograma-{{$metaSubPrograma->id}}"
                                               href="#ConfirmDeleteMetaSubPrograma-{{$metaSubPrograma->id}}"
                                               class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal" id="ConfirmDeleteMetaSubPrograma-{{$metaSubPrograma->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Confirmación</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h6>¿Realmente desea eliminar el registro seleccionado?</h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <a href="plan_desarrollo/meta/{{$metaSubPrograma->id}}/eliminar" class="btn btn-danger">Eliminar Registro</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-2"></div>
        <div class="container" align="center">
            <?php echo str_replace('/?', '?', $plan_desarrollo->render()) ?>
        </div>
    </div>

@stop