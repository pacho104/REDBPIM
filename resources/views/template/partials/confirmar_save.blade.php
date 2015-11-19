<div id="myModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
                <h4 class="modal-title">Confirmación</h4>
            </div>
            <div class="modal-body">
                <h6>¿Realmente desea guardar el Estado?</h6>
            </div>
            <div class="modal-footer">
                {!!Form::submit('Cancelar',['class'=>'btn btn-default','data-dismiss'=>'modal']) !!}
                {!!Form::submit('Registrar',['class'=>'btn btn-primary']) !!}

            </div>
        </div>
    </div>
</div>