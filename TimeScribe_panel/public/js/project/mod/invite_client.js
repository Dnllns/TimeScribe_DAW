$(function() {



    //---------------
    $('#send-invitation-container').on('click', "#send-invitation", function(event) {



        event.preventDefault()

        //Obtener los datos
        var guestEmail = $("#client_email").val()
        var guestName = $("#client_name").val()

        //Peticion al servidor
        //-------------------------

        //generar json
        var postData = [{
            "guestName": guestName,
            "guestEmail": guestEmail,
            "adminName": adminName,
            "projectId": projectId,
            "projectName": projectName
        }]



        $.ajax({
            url: '/email/send-client-invitation',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            contentType: 'json',
            processData: false,
            data: JSON.stringify(postData),
            success: function(data) {

                /*PETICION CORRECTA, EMAIL ENVIADO*/
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

    //Ocultar menu de enviar email
    $('#send-invitation-container').addClass("d-none")

    // Si la alerta de no hay invitaciones exite
    if ($('#addclient-alert .alert').length > 0) {

        //Eliminar alerta
        deleteElement($('#addclient-alert div'))

    }

    mensajeEmailCorrecto()

    if($('#client-invitation-list').hasClass('d-none')){
        $('#client-invitation-list').removeClass('d-none')
    }

    //Si la lista no existe se crea
    if( !$('#client-invitation-list ul').length){
        $('#client-invitation-list').append("<ul class='list-group'></ul>")
    }



    //Añadir a la lista de invitaciones pendientes
    //----------------------------

    var nombre = $("#client_name").val()
    var email = $("#client_email").val()

    $('#client-invitation-list ul').append(

        "<li class='list-group-item' data-invitationid='" + invitationId +"'>" +
        "<div class='row'>" +
        "<div class='col-10'>" + email + "</div>" +
        "<div class='col'>" +
        "<div class='float-right'>" +
        "<a href='' class='btn btn-circle btn-sm bg-dark text-white' data-remove-invitation data-funkyct='/email/remove-wg-invitation/" + invitationId + "'>" +
        "<i class='fas fa-trash-alt'></i>" +
        "</a>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</li>"

    )

}


function iA_EmailNoEnviado(){

    $("#addclient-alert").append(
        "<div class='col-12 pt-2'>"+
        getAlert("", "danger", "There was an error sending the invitation email")+
        "</div>"
    )

}



function mensajeEmailCorrecto(){
    // Ocultar el mostrar mensaje de Email correcto tras 5 segundos
    window.setTimeout(
        function() {
            deleteElement($("#addclient-alert .alert.alert-success"))
        },
        3000
    )

    //mostrar mensaje de Email correcto
    $("#addclient-alert").append(
        "<div class='col-12 pt-4'>"+
        getAlert("", "success", "The invitation email has been sent correctly") +
        "</div>"
    )
}
