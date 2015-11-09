@extends('template.partials.formatoPDF')
@section('contenido')



        <div id="header">
            <table>
                <tr>
                    <td><img src = "{{$logo}}" name="img" class="img-thumbnail" ></td>
                    <td align="center">{!!$formatoEBan->encabezado_formato!!}</td>
                </tr>
            </table>
        </div>

        <div id="footer">
            <div class="page-number"></div>
        </div>

            {!!$cuerpo!!}<br><br><br><br><br><br>


        Atentamente<br><br><br><br>
        <table border="0" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
                <td align="justify">
                    {{$nombreUsu}}
                </td>
            </tr>
            <tr>
                <td align="justify">
                    C.C. {{$nuevaC}}
                </td>
            </tr>
            </tbody>
        </table>

        <hr/>

@stop
