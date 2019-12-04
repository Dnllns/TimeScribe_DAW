$(function() {


    // LISTA ELIMINAR
    //---------------
    $('body').on('click', "#send-invitation", function(event) {



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
                console.log('succes: ' + data);
            }
        });





    })


})