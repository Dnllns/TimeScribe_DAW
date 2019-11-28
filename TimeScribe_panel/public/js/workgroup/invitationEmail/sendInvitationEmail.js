$(function() {

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
                console.log('succes: ' + data);
            }
        });





    })

})