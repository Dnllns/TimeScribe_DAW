$(function() {



    //Click eliminar desarrollador de la lista
    $("a[data-remove-developer]").click(function(event) {

        event.preventDefault()

        //Peticion al servidor
        //-------------------
        $.get($(this).attr("data-funct"))

        //Eliminar de la interface
        //-------------------

        //Borrar de la lista
        $(this).closest("li").remove()


        //La lista esta vacía

        //NO deberia de ser necesario (admin no eliminable)

        // if ($("#dev-list ul li").length == 0) {

        //     //Borrar la lista
        //     $("#dev-list ul").remove()

        //     //Añadir mensaje de alerta
        //     $("#dev-list").append(


        //         getAlert("alert-dev-list", "warning", "Currently no developer has been added.")

        //         // "<div id='alert-dev-list'>" +
        //         // "<div class='alert alert-warning alert-dismissible fade show' role='alert'>" +
        //         // "Currently no developer has been added." +
        //         // "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
        //         // "<span aria-hidden='true'>×</span>" +
        //         // "</button>" +
        //         // "</div>" +
        //         // "</div>"
        //     )

        // }
    })

       //Click eliminar desarrollador de la lista
    $("a[data-remove-invitation]").click(function(event) {


        event.preventDefault()
        var listItem = $(this).closest("li")
        var peticionRoute = $(this).attr("data-funct")


        //Peticion al servidor
        //-------------------
        var responseRemoveInvitation

        $.get(
            peticionRoute,
            function(data, status){
                if(status == "success" && data=="true"){

                    //Borrar LI de la lista
                    listItem.remove()

                    //La lista esta vacía
                    if ($("#invitation-list ul li").length == 0) {

                        //Borrar la lista
                        $("#invitation-list ul").remove()

                        //Añadir mensaje de alerta
                        $("#invitation-list").append(
                            "<div class='col-12'>" +
                            getAlert("alert-dev-list", "warning", "Currently no developer has been added.") +
                            "</div>"
                        )

                    }
                }
            }
        )



    })




    //Click enviar invitacion
    // $("#add-developers-btn").click(function(event) {

    //     event.preventDefault()

    //     //Peticion al servidor
    //     //-------------------
    //     $.get($(this).attr("data-funct"))

    //     //Preparar interface
    //     //-------------------

    //     // Si la alerta exite
    //     if ($('#invitation-alert').length != 0) {

    //         //Eliminar alerta
    //         $('#invitation-alert').remove()

    //         //Crear la lista
    //         $('#invitations').append(

    //             "<div id='invitation-list'>" +
    //             "<ul class='list-group'></ul>" +
    //             "</div>"

    //         )

    //     }

    //     //Añadir a la lista de invitaciones pendientes
    //     //----------------------------

    //     var nombre = $("#add-developers input[name='adddev-name']").val()
    //     var email = $("#add-developers input[name='addev-email']").val()

    //     $("#invitation-list ul").append(

    //         "<li class='list-group-item'>" +
    //         "<div class='row'>" +
    //         "<div class='col-10'>" + nombre + ", " + email + "</div>" +
    //         "<div class='col'>" +
    //         "<div class='float-right'>" +
    //         "<a href='' class='btn btn-circle btn-sm bg-dark text-white' data-remove>" +
    //         "<i class='fas fa-trash-alt'></i>" +
    //         "</a>" +
    //         "</div>" +
    //         "</div>" +
    //         "</div>" +
    //         "</li>"

    //     )

    // })



});
