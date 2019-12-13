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

                //Peticion correcta, Email enviado
                //------------------------------------

                //Crear usuario (Peticion al servidor)
                $.get($("#add-developers-btn").attr("data-funct"))

                //Preparar interface
                //-------------------

                // Si la alerta exite
                if ($('#invitation-alert').length > 0) {

                    //Eliminar alerta
                    $('#invitation-alert').remove()

                }

                //Si la lista no existe se crea
                if($('#invitation-list').length == 0){
                    $('#invitation-list').append(
                        "<div id='invitation-list'>" +
                        "<ul class='list-group'></ul>" +
                        "</div>"
                    )
                }

                //mostrar mensaje de Email correcto
                $("#add-developers .row").append(
                    "<div class='col-12 pt-4'>"+
                    getAlert("", "success", "The invitation email has been sent correctly") +
                    "</div>"
                )

                //Añadir a la lista de invitaciones pendientes
                //----------------------------

                var nombre = $("#add-developers input[name='adddev-name']").val()
                var email = $("#add-developers input[name='addev-email']").val()

                $("#invitation-list ul").append(

                    "<li class='list-group-item' data-invitationid='" + data +"'>" +
                    "<div class='row'>" +
                    "<div class='col-10'>" + nombre + ", " + email + "</div>" +
                    "<div class='col'>" +
                    "<div class='float-right'>" +
                    "<a href='' class='btn btn-circle btn-sm bg-dark text-white' data-remove>" +
                    "<i class='fas fa-trash-alt'></i>" +
                    "</a>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</li>"

                )
            },
            error: function(data){

                //Peticion fallida, mostrar mensaje de alerta

                $("#add-developers .row").append(
                    "<div class='col-12 pt-4'>"+
                    getAlert("", "alert", "There was an error sending the invitation email")+
                    "</div>"
                )
            }
        });





    })



})
