(function(){


     // TASKGROUP LISTA ELIMINAR
    //--------------
    $('#taskgroup-list').on('click', "a[data-del]", function(event) {
        delTaskGroup(event, $(this))
    })

})



// -----------------------------------------------------------
//                      TASKGROUP LISTA ELIMINAR
// -----------------------------------------------------------

function delTaskGroup(event, element) {

    event.preventDefault()

    // Peticion al servidor
    //----------------------
    $.get(element.attr('data-funct'))

    //Si el usuario es admin mostar como oculto
    //Si el usuario no es admin eliminar de la lista
    //(Variable showDeleteds creada en el server)

    var alertMessage = ""

    if(showDeleteds){
        element.closest("li").find("span i.fa-eye")
        .removeClass("fa-eye")
        .addClass("fa-eye-slash")

        alertMessage = " invisible for the standard users."
    }
    else{
        element.closest("li").remove()
        alertMessage = " deleted."

    }


    //-----------------------

    //Mostrar mensaje de eliminado
    $('#taskgroup-list').append(

        "<div class='col-12 pt-2'>" +
        "<div class='alert alert-success alert-dismissible fade show' role='alert'>" +
        "The task group has become" + alertMessage +
        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
        "<span aria-hidden='true'>&times;</span>" +
        "</button>" +
        "</div>" +
        "</div>"
    )

    //Ocultar mensaje 2 segundos despues
    window.setTimeout(
        function() { $("#taskgroup-list .alert.alert-success").fadeTo(500, 0).slideUp(500, function() { $(this).remove() }) }, 2000
    )




    //Preparar interface
    //------------------------
    if ($('#taskgroup-list ul li').length == 0) {

        // La lista esta vacia
        // Eliminar la lista
        $('#taskgroup-list ul').remove()

        // Mostrar aviso de lista vacía

        $('#taskgroup-list').append(

            "<div id='taskgroup-list-alert' class='col-12'>" +
            "<div class='alert alert-warning alert-dismissible fade show' role='alert'>" +
            "Currently no task group has been added." +
            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
            "<span aria-hidden='true'>&times;</span>" +
            "</button>" +
            "</div>" +
            "</div>"

        )

    }



}
