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

           <div class="container-fluid ">
                <div class="col-md-1"> </div>
                <fieldset>
                    <ul class="nav nav-tabs " >
                        <li class="col-lg-2"><a href="{{route('new_plan_municipal')}}"><big> 1. </big>Plan de desarrollo</a></li>
                        <li class="disabled col-md-2"><a><big> 2. </big>Eje estratégico</a></li>
                        <li class="disabled col-md-2"><a><big> 3. </big>Programa</a></li>
                        <li class="disabled col-md-2"><a><big> 4. </big>SubProgramas</a></li>
                        <li class="disabled col-md-2"><a><big> 5. </big>Metas</a></li>
                    </ul>
                </fieldset>
           </div>

        </div>

    @stop