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