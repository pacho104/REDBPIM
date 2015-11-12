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

    <div class="row-fluid">
        <div class="container" id="admin">
            <h4> Acciones para la Secretaria de Planeacion Municipal </h4>
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

        <div>
        <div class="col-md-1"></div>
        </div>

    </ul>

    <ul class="ca-menu">

        <li>
            <a href="#">
                <span class="ca-icon">S</span>
                <div class="ca-content">
                <h2 class="ca-main">Sophisticated Team</h2>
                </div>
            </a>
        </li>

        <div>
        <div class="col-md-1"></div>
        </div>

        <li>
            <a href="#">
                <span class="ca-icon">S</span>
                <div class="ca-content">
                <h2 class="ca-main">Sophisticated Team</h2>
                </div>
            </a>
        </li>

        <div>
        <div class="col-md-1"></div>
        </div>

        <li>
            <a href="#">
                <span class="ca-icon">S</span>
                <div class="ca-content">
                <h2 class="ca-main">Sophisticated Team</h2>
                </div>
            </a>
        </li>

    </ul>

@stop