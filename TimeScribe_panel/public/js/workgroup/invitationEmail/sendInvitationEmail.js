$(function() {

    /**
     * Click en boton de enviar invitacion
     * --------------------------------------
     */
    $("#add-developers-btn").click(function(event) {

        event.preventDefault()

        //Obtener los datos
        var guestName = $("input[name='adddev-name']").val()
        var guestEmail = $("input[name='addev-email']").val()


        //Peticion al servidor
        //-------------------------

        //generar json
        var postData = [{
            "guestName": guestName,
            "guestEmail": guestEmail,
            "adminName": adminName,
            "workgroupId": workgroupId,
            "workgroupName": workgroupName
        }]

        $.ajax({
            url: '/email/send-workgroup-invitation',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            contentType: 'json',
            processData: false,
            data: JSON.stringify(postData),
            success: function(data) {

                /*PETICION CORRECTA, EMAIL ENVIADO*/

                //Crear usuario (Peticion al servidor)
                var rutaCrearUsuario = $("#add-developers-btn").attr("data-funct")
                $.get(rutaCrearUsuario)

                //Preparar interface
                iA_EmailEnviado(data)

            },
            error: function(data){

                //Peticion fallida, mostrar mensaje de alerta
                iA_EmailNoEnviado()

            }
        });





    })



})



function iA_EmailEnviado(invitationId){

    // Si la alerta de no hay invitaciones exite
    if ($('#invitation-alert').length > 0) {

        //Eliminar alerta
        deleteElement($('#invitation-alert'))

    }


    //Si la lista no existe se crea
    if($('#invitation-list').length == 0){
        $('#invitations').append("<div id='invitation-list'></div>")
    }
    //Si la lista no existe se crea
    if($('#invitation-list ul').length == 0){
        $('#invitation-list').append("<ul class='list-group'></ul>")
    }


    mensajeEmailCorrecto()

    //Añadir a la lista de invitaciones pendientes
    //----------------------------

    var nombre = $("#add-developers input[name='adddev-name']").val()
    var email = $("#add-developers input[name='addev-email']").val()

    $("#invitation-list ul").append(

        "<li class='list-group-item' data-invitationid='" + invitationId +"'>" +
        "<div class='row'>" +
        "<div class='col-10'>" + email + "</div>" +
        "<div class='col'>" +
        "<div class='float-right'>" +
        "<a href='' class='btn btn-circle btn-sm bg-dark text-white' data-remove-invitation data-funct='/email/remove-wg-invitation/" + invitationId + "'>" +
        "<i class='fas fa-trash-alt'></i>" +
        "</a>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</li>"

    )

}

function iA_EmailNoEnviado(){

    $("#add-developers .row").append(
        "<div class='col-12 pt-2'>"+
        getAlert("", "danger", "There was an error sending the invitation email")+
        "</div>"
    )

}


function mensajeEmailCorrecto(){
        // Ocultar el mostrar mensaje de Email correcto tras 5 segundos
        window.setTimeout(
        function() {
            deleteElement($("#add-developers .row .alert.alert-success"))
        },
        3000
    )

    //mostrar mensaje de Email correcto
    $("#add-developers .row").prepend(
        "<div class='col-12 pt-4'>"+
        getAlert("", "success", "The invitation email has been sent correctly") +
        "</div>"
    )
}

