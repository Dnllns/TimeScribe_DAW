$(function() {

    $('#adddev').click(function(event) {

        // Anular el efecto de click en el enlace
        event.preventDefault();

        //Obtener el id del dev seleccionado
        var selectedItem = $('#devsselector').children(":selected");
        var devId = selectedItem.attr("value");

        // Obtener la ruta de la peticion
        var ruta = $('#adddev').attr('data-funct');
        ruta = ruta.replace('devId', devId);

        // Peticion al server
        $.ajax({ url: ruta });

        //----- Actualizar interface ---------
        //------------------------------------

        // Obtener el contenido (Usado mas tarde)
        var itemContent = selectedItem.html();
        //Eliminar el item seleccionado del select
        selectedItem.remove();
        //Anadir a la lista de desarrolladores

        var taskId = $('#taskcard').attr('data-taskid');

        var devListContent = $('#devlist').html();

        $('#devlist').html(devListContent +
            "<li>" +
            "<div class='row'>" +
            "<div class='col'>" + itemContent + "</div>" +
            "<div class='col'>" +
            "<a data-id='" + devId + "' data-funct='' href='/task-deldev-bd/" + taskId + "/" + devId + "' class='btn btn-sm text-danger f-remove'>" +
            "<i class='fas fa-trash-alt'></i>" +
            "</a>" +
            "</div>" +
            "</div>" +
            "</li>"
        );

        //Si el select esta vacío mostrar un alert
        if ($('#devsselector').html().trim() == "") {
            $('#adddevscontainer').html(

                "<div class='col-12'>" +
                "<div class='alert alert-warning alert-dismissible fade show' role='alert'>" +
                "There isn't more developers availables" +
                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                "<span aria-hidden='true'>&times;</span>" +
                "</button>" +
                "</div>" +
                "</div>"
            );
        }



    });


    $('#devlist a.f-remove').click(function(event) {

        event.preventDefault();


        if (confirm("Seguro que desea eliminar?")) {

            // Obtener la tuta
            var ruta = $(this).attr('data-funct');

            // peticion al servidor
            $.ajax({ url: ruta });

            //ELiminar el developer de la lista
            $(this).closest("li").remove();

            //Mensaje de aviso de borrado realizado

            $('#devlist').before(
                "<div class='col-12 mt-2'>" +
                "<div class='alert alert-success alert-dismissible fade show' role='alert'>" +
                "The devellober has been deleted" +
                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                "<span aria-hidden='true'>&times;</span>" +
                "</button>" +
                "</div>" +
                "</div>"
            );

        }

    });

})