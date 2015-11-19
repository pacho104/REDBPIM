function seleccionar()
{

    $("#seleTodo").change(function () {
        if ($(this).is(':checked')) {

            $("#check input[type=checkbox]").prop('checked', true); //solo los del objeto #diasHabilitados
        } else {

            $("#check input[type=checkbox]").prop('checked', false);//solo los del objeto #diasHabilitados
        }

    });

    $("#seleTodo1").change(function () {
        if ($(this).is(':checked')) {

            $("#check2 input[type=checkbox]").prop('checked', true); //solo los del objeto #diasHabilitados
        } else {

            $("#check2 input[type=checkbox]").prop('checked', false);//solo los del objeto #diasHabilitados
        }

    });

}
function sendReq(event) {

        document.reqFrom.submit();

}
function sendLogo(event){


        document.reqFromLogo.submit();
}

