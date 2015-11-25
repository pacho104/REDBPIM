@extends('template.main')
@section('title'){{ 'Red BPIM - ' . Auth::user()->user_login }} @endsection
@section('content')

    @include('template.partials.logbar_sec')

    @if(\Session::has('AlertUserUpdate'))
        <div class="alert alert-dismissible alert-success fontbig">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{Session::get('AlertUserUpdate')}}</strong>
        </div>
    @endif


    <div class="container">
        <div class="jumbotrom">
            <h4 class="text-center">
                Procesos del BPIM - Secretaría Sectorial
            </h4>
        </div>
    </div>

    <ul class="ca-menu">
        <li>
            <a href="#">
                <span class="ca-icon">Verificación de Requisitos</span>
                <div class="ca-content">
                <h2 class="ca-main">Verificación de Requisitos</h2>
                </div>
            </a>
        </li>

        <div>
        <div class="col-md-1"></div>
        </div>

        <li>
            <a href="#">
                <span class="ca-icon">Viabilidad</span>
                <div class="ca-content">
                <h2 class="ca-main">Viabilidad</h2>
                </div>
            </a>
        </li>

        <div>
        <div class="col-md-1"></div>
        </div>

        <li>
            <a href="#">
                <span class="ca-icon">Registro</span>
                <div class="ca-content">
                <h2 class="ca-main">Registro</h2>
                </div>
            </a>
        </li>

    </ul>

    <div class="row-fluid">
        <div class="container"></div>
    </div>


    <ul class="ca-menu">
        <li>
            <a href="#">
                <span class="ca-icon">Priorización</span>
                <div class="ca-content">
                <h2 class="ca-main">Priorización</h2>
                </div>
            </a>
        </li>

        <div>
        <div class="col-md-1"></div>
        </div>

        <li>
            <a href="#">
                <span class="ca-icon">Aprobación</span>
                <div class="ca-content">
                <h2 class="ca-main">Aprobación</h2>
                </div>
            </a>
        </li>

        <div>
        <div class="col-md-1"></div>
        </div>

        <li>
            <a href="#">
                <span class="ca-icon">Ajustes y Correcciones</span>
                <div class="ca-content">
                <h2 class="ca-main">Ajustes y Correcciones</h2>
                </div>
            </a>
        </li>

    </ul>

@stop