$(function() {



    //Click eliminar desarrollador de la lista 
    $("a.f-remove").click(function(event) {

        event.preventDefault()

        //Peticion al servidor
        //-------------------
        $.get($(this).attr("data-funct"))

        //Eliminar de la interface
        //-------------------

        //Borrar de la lista
        $(this).closest("li").remove()


        //La lista esta vacía
        if ($("#dev-list ul li").lenght == 0) {

            //Borrar la lista
            $("#dev-list ul").remove()

            //Añadir mensaje de alerta
            $("#dev-list").append(

                "<div id='alert-dev-list'>" +
                "<div class='alert alert-warning alert-dismissible fade show' role='alert'>" +
                "Currently no developer has been added." +
                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                "<span aria-hidden='true'>×</span>" +
                "</button>" +
                "</div>" +
                "</div>"
            )

        }
    })





    //Click enviar invitacion
    $("#add-developers-btn").click(function(event) {

        event.preventDefault()

        //Peticion al servidor
        //-------------------
        $.get($(this).attr("data-funct"))

        //Preparar interface
        //-------------------

        // Si la alerta exite
        if ($('#invitation-alert').lenght != 0) {

            //Eliminar alerta
            $('#invitation-alert').remove()

            //Crear la lista
            $('#invitations').append(

                "<div id='invitation-list'>" +
                "<ul class='list-group'></ul>" +
                "</div>"

            )

        }

        //Añadir a la lista de invitaciones pendientes
        //----------------------------

        var nombre = $("#add-developers input[name='adddev-name']").val()
        var email = $("#add-developers input[name='addev-email']").val()

        $("#invitation-list ul").append(

            "<li class='list-group-item'>" +
            "<div class='row'>" +
            "<div class='col-10'>" + nombre + ", " + email + "</div>" +
            "<div class='col'>" +
            "<div class='float-right'>" +
            "<a href='' class='text-danger'>" +
            "<i class='fas fa-trash-alt'></i>" +
            "</a>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</li>"

        )

    })



});