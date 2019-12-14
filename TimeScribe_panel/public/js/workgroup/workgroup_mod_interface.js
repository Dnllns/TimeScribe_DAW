$(function() {


    //Click eliminar desarrollador de la lista
    $('#dev-list').on('click', "a[data-remove-developer]", function(event) {

        event.preventDefault()

        //Peticion al servidor
        var deleteUserRoute = $(this).attr("data-funct")
        var liItem = $(this).closest("li")


        $.get(
            deleteUserRoute,
            function(data, status){ eliminarDesarrollador(data, status, liItem) }
        )

    })

    //Click eliminar invitacion de la lista
    $('#invitations').on('click', "a[data-remove-invitation]", function(event) {

        event.preventDefault()
        var listItem = $(this).closest("li")
        var peticionRoute = $(this).attr("data-funct")


        //Peticion al servidor
        $.get(
            peticionRoute,
            function(data, status){ eliminarInvitacion(data, status, listItem) }
        )

    })



});


function eliminarInvitacion( data, status, liElement){


    if(status == "success" && data=="true"){

        //Borrar LI de la lista
        liElement.remove()

        mensajeInvitacionEliminada()

        //Comprobar si la lista esta vacía
        if ($("#invitation-list ul li").length == 0) {

            //Borrar la lista
            $("#invitation-list ul").remove()

            //Añadir mensaje de alerta No hay invitaciones
            $("#invitations").append(
                "<div id='invitation-alert' class='col-12'>" +
                    getAlert("", "warning", "Currently there is no pendig invitation.") +
                "</div>"
            )

        }
    }
    else{

        //Mensaje de invitacion eliminada
        $("#invitations").append(
            "<div class='col-12'>" +
                getAlert("", "danger", "There was a problem during the deletion...") +
            "</div>"
        )

    }

}

function eliminarDesarrollador(data, status, liElement){

    if(status == "success" && data=="true"){

        //Borrar de la lista
        liElement.remove()

        //Cierrre automatico del aviso
        window.setTimeout(
            function() { deleteElement($('#dev-list .alert.alert-success')) },
            3000
        )

        //Mensaje de Aviso borrado correcto
        $("#dev-list").prepend(
            "<div id='' class='col-12'>" +
                getAlert("", "success", "The developer has been removed from workgroup.") +
            "</div>"
        )

    } else {

        //Mensaje de Aviso borrado correcto
        $("#dev-list").prepend(
            "<div id='' class='col-12'>" +
                getAlert("", "danger", "There was an error while the user was removed from workgroup.") +
            "</div>"
        )

    }

}

function mensajeInvitacionEliminada(){

    var element = $("#invitation-list div .alert.alert-success")

    // Ocultar el mensaje de eliminacion correcta tras 5 segundos
    window.setTimeout(
        function() { deleteElement(element) },
        3000
    )

    //Mensaje de invitacion eliminada
    $("#invitation-list").prepend(
        "<div class='col-12 pb-2'>" +
        getAlert("", "success", "The invitation has been deleted successfully.") +
        "</div>"
    )

}
