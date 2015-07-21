@extends('template.main')
@section('title'){{ 'Red BPIM - '. Auth::user()->user_login }} @endsection
@section('content')
    @include('template.partials.logbar')
    <div class="row-fluid">
        <div class="container" id="admin">
            {!!Auth::user()->user_login!!}
        </div>
    </div>
@stop
