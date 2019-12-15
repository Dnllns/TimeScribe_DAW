$(function(){


    $('#client-invitation-list').on('click', "a[data-remove-invitation]", function(event) {

        event.preventDefault()

        var invitationId = $(this).attr("data-invitationid")
        var rutaPeticionEliminarInvitacion = "/email/client-delete-invitation/" + invitationId

        $.get(rutaPeticionEliminarInvitacion)

        $(this).closest("ul").remove()
        $('#client-invitation-list').addClass("d-none")


        //mostar el panel de enviar email
        $('#send-invitation-container').removeClass("d-none")

    })




})
