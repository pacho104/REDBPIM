@if(\Session::has('message'))
    <div class="alert alert-dismissible alert-success fontbig">
        {!!Form::submit('×',['class'=>'close','data-dismiss'=>'alert'])!!}
        <strong>{{\Session::get('message')}}</strong>
    </div>
@endif