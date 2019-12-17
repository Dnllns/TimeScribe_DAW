$(function(){


    $('.card-body').on('click', "#current-client a", function(event) {

        event.preventDefault()

        var clientId = $(this).attr("data-clientid")
        var projectId = $(this).attr("data-projectId")

        var rutaPeticionEliminarInvitacion = "/remove-client/"  + projectId + "/" + clientId

        $.get(rutaPeticionEliminarInvitacion)

        $('#current-client').html("")

        //mostar el panel de enviar email
        $('#send-invitation-container').removeClass("d-none")

    })




})
