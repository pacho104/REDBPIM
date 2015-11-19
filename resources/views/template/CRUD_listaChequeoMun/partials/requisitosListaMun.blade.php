<div class=" col-lg-4">
    <h5 align="center">REQUISITOS AGREGADOS A LA LISTA</h5>
    <div>
        <li class="nav nav-tabs navbarfont navbar-right">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{!!Form::checkbox('name',null,null,['id'=>'seleTodo1','onclick'=>'seleccionar()'])!!}Seleccionar Todo</li>
    </div>
    <div>

        {!!Form::model(Request::all(),['route'=>['req',$idLista],'method'=>'GET']) !!}
        <li class="nav nav-tabs navbarfont navbar-right">{!!Form::text('nom_requisito2',null,['class'=>'form-control col-md-2','placeholder'=>'Requisito'])!!}
            {!!Form::submit('Buscar',['class'=>'btn btn-default','data-dismiss'=>'modal'])!!}</li>
        {!!Form::close()!!}

    </div>


    <table class="table table-striped" >
        <thead>
        <th class="col-md-8 " >REQUISITO</th>
        <th class="col-md-1 " >SELECCIONAR</th>
        </thead>
        <tbody class="table-stripe tbody1" id="lista2" >
        {!!Form::open(['url'=>['elReq',$idLista],'method'=>'GET','role'=>'form','name'=>'reqFrom']) !!}
        @foreach($requisitoLista as $re)
            <tr>
                <td align="justify">{{$re->nom_requisito}}</td>

                <td class="col-md-1" id="check2" align="right">{!!Form::checkbox('che2[]',$re->id,null,['id'=>'seleDos'])!!}</td>

            </tr>
        @endforeach
        {!!Form::close()!!}
        <tbody>
    </table>
</div>