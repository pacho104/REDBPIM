<div class="col-lg-4">
    <h5 align="center">LISTA DE TODOS LOS REQUISITOS</h5>
    <div>
        <li class="nav nav-tabs navbarfont navbar-right">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{!!Form::checkbox('name',null,null,['id'=>'seleTodo','onclick'=>'seleccionar()'])!!}Seleccionar Todo</li>
    </div>
    <div>
        {!!Form::model(Request::all(),['route'=>['reqMun',$idLista],'method'=>'GET','role'=>'search']) !!}
        <li class="nav nav-tabs navbarfont navbar-right">{!!Form::text('nom_requisito1',null,['class'=>'form-control col-md-2','placeholder'=>'Requisito'])!!}
            {!!Form::submit('Buscar',['class'=>'btn btn-default','data-dismiss'=>'modal'])!!}</li>

        {!!Form::close()!!}

    </div>
    {!!Form::open(['url'=>['nue'],'method'=>'GET'])!!}
    <table class="table table-striped">
        <thead>
        <th class="col-md-8 " align="left">REQUISITO</th>
        <th class="col-md-1 " align="right" >SELECCIONAR</th>
        </thead>
        <tbody class="table-stripe tbody1" id="lista1" >
        <input type="hidden"  name="idLi" value="{{$idLista}}">
        @foreach($requisitoBan as $re)

            <tr>
                <td align="justify">{{$re->nom_requisito}}</td>

                <td class="col-md-1" id="check" align="right">{!!Form::checkbox('che1[]',$re->id,null,['id'=>'seleUno'])!!}</td>

            </tr>
        @endforeach

        <tbody>
    </table>

</div>
<div class="col-lg-1">
</div>