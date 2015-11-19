@extends('template.main')

<div id='showModal' class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href='/auth/login' class="close" style="font-size: 18px"> <i class="fa fa-times"></i>
                </a>
                <h4 class="modal-title">Importante!</h4>
            </div>
            <div class="modal-body">
                <h6>Su registro esta siendo verificado por el administrador del sistema.</h6>
                <h6>En un plazo máximo de 24 horas se enviará una respuesta por parte del administrador.</h6>
            </div>
        </div>
    </div>
</div>
