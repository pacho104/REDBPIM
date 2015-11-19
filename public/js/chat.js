/**
 * Created by SILVER on 24/09/2015.
 */
// Change localhost to the name or ip address of the host running the chat server
var chatUrl="ws://127.0.0.1:3000/";


function mostrarUsuarios(listaUser){

    var tabla=document.getElementById('lista');
    var fila = tabla.rows.length;

    if(fila>=0)
    {
        for(var q=0;q<fila;q++) {
            var resta=q+1;
            tabla.deleteRow(q-resta);
        }
    }

    for (var i = 0; i < listaUser.length; i++) {
        /** @namespace this.lista */
        this.lista.innerHTML += '<td>' + listaUser[i].name + '</td>';
    }

}

function displayChatMessage(from,message,timeEnvio) {

    var node = document.createElement("LI");

    if (from) {
        var nameNode = document.createElement("STRONG");
        var nameTextNode = document.createTextNode(from);
        nameNode.appendChild(nameTextNode);
        node.appendChild(nameNode);
    }


    var messageTextNode = document.createTextNode(message);
    node.appendChild(messageTextNode);


    var date = new Date(timeEnvio*1000);
    var mes=date.getMonth()+1;
    var dia=date.getDate();
    var anyo=date.getFullYear();
    var hor=date.getHours();
    var min=date.getMinutes();
    var seg=date.getSeconds();




    if(mes.toString().length==1){mes='0'+mes;}
    if(dia.toString().length==1){dia='0'+dia;}
    if(hor.toString().length==1){hor='0'+hor;}
    if(min.toString().length==1){min='0'+min;}
    if(seg.toString().length==1){seg='0'+seg;}


    var fecha=hor+':'+min+':'+seg+' -- '+anyo+'-'+mes+'-'+dia;



    if(from == null)
    {
        this.chatwindow.innerHTML += '<td>'+'<p>' +message + '</p>'+'</td>'+'<span dir="auto" style="opacity: 0; position: absolute;"></span>';
        var mesa = document.getElementById("chatwindow");
        mesa.scrollTop = mesa.scrollHeight;
    }
    else{
        this.chatwindow.innerHTML += '<td>' + '<small class="pull-right time"><i class="fa fa-clock-o"></i>' + fecha + '</small>' + '<small class="pull-left username">' + from + '</small><br>' +
        '<p align="justify">' + message + '</p><br>' + '</td>' + '<span dir="auto" style="opacity: 0; position: absolute;overflow-scrolling: auto;"></span>';

        var mesa = document.getElementById("chatwindow");
        mesa.scrollTop = mesa.scrollHeight;
    }

}



var conn;
var roo;
var user;

function connectToChat() {

    conn = new WebSocket(chatUrl);


    conn.onopen = function() {
        document.getElementById('connectFormDialog').style.display = 'none';
        document.getElementById('messageDialog').style.display = 'block';
        roo=document.getElementsByName("room.name")[0].value;
        user=document.getElementsByName("user.name")[0].value;

        var params = {
            'roomId': roo,
            'userName': user,
            'action': 'connect'
        };
        console.log(params);
        conn.send(JSON.stringify(params));
    };

    conn.onmessage = function(e) {
        console.log(e);
        var data = JSON.parse(e.data);

        if (data.hasOwnProperty('message') && data.hasOwnProperty('from')) {

            displayChatMessage(data.from.name, data.message,data.timestamp);

        }else if (data.hasOwnProperty('message')) {

            displayChatMessage(null, data.message);

        }
        else if (data.hasOwnProperty('type')) {
            if (data.type == 'list-users' && data.hasOwnProperty('clients')) {

                mostrarUsuarios(data.clients);
                displayChatMessage(null, 'Actualmente hay ' + data.clients.length + ' usuarios en la sala');
            }
        }




    };

    conn.onerror = function(e) {
        console.log(e);
    };

    return false;
}

function sendChatMessage(event) {


    var msj = $("#messagebox").val();

    if(event.keyCode == 13&& msj.length==0){
        return false;
    }

    if (event.keyCode == 13 && msj.length>0) {
        var formulario = $("#messageForm").serializeArray();

        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/crearMesa/" + roo,
            data: formulario
        });

        var d = new Date();
        var params = {
            'message': document.getElementsByName("message")[0].value,
            'action': 'message',
            'timestamp': d.getTime() / 1000,
            'roomId': roo
        };
        conn.send(JSON.stringify(params));

        document.getElementsByName("message")[0].value = '';


        return false;

    }
}
function seleccionar()
{

    $("#seleTodo").change(function () {
        if ($(this).is(':checked')) {

            $("#check input[type=checkbox]").prop('checked', true); //solo los del objeto #diasHabilitados
        } else {

            $("#check input[type=checkbox]").prop('checked', false);//solo los del objeto #diasHabilitados
        }

    });

}

