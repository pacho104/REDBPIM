@if(\Session::has('alert'))
    <div class="alert alert-dismissible alert-success fontbig">

        {!!Form::submit('×',['class'=>'close','data-dismiss'=>'alert'])!!}
        <strong>{{\Session::get('alert')}}</strong>
    </div>
@endif
@if(\Session::has('ValidationDelete'))
    <div id="dangercolor" class="alert alert-dismissible alert-danger">
        {!!Form::submit('×',['class'=>'close','data-dismiss'=>'alert'])!!}
        <i class="fa fa-exclamation-triangle"></i>
        {{Session::get('ValidationDelete')}}
    </div>
@endif