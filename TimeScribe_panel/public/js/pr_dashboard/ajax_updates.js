/**
 * Script de actualizaciones Ajax
 * ----------------------------------
 * 
 * Hace las peticiones al servidor relacionadas con la vista de project dashboard
 * 
 * 
 */

$(function() {

    // CLICK BTN STARTNEW (TODO)
    // Actualiza en BD la tabla tasks,
    // inserta en el campo start_date la fecha actual

    // CLICK BTN DONE (DONE)
    // Actualiza en BD la tabla tasks,
    // Pone el valor de status a 2 (DONE)

    // CLICK REMOVE TASK (DONE)
    // Actualiza en BD en la tabla tasks,
    // Pone el valor de visible a 0 (Invisible)

    $("i[data-funct]").click(function() {

        var ruta = $(this).attr('data-ajax-route')
        $.get(ruta)

        //EL Boton de seleccionar no recarga la página
        if ($(this).attr("data-funct") != "select" && $(this).attr("data-funct") != "view") {
            location.reload()
        } else {

            //set the taskid to the attr (not necesary)
            var taskId = $("#sticky-chrono").attr("data-current-taskid")
                //actualizar las rutas con el id de la tarea
            var startRoute = $("#chrono-start").attr("data-start-route") + "/" + taskId
            $("#chrono-start").attr("data-start-route", startRoute)
            var resetRoute = $("#chrono-reset").attr("data-reset-route") + "/" + taskId
            $("#chrono-reset").attr("data-reset-route", resetRoute)

        }

    })



    ////---------------STYKYCHRONO-------------------

    //Evento start para los buttons que encienden el crono
    $("#chrono-start").click(function() {

        var currentFunction = $(this).attr("data-chronofunct")

        switch (currentFunction) {

            case "start" || "resume":
                // Actualiza en BD la tabla tasks, 
                // inserta en el campo start_date la fecha actual
                $.get($(this).attr("data-start-route"))
                break

            case "stop":
                // Inserta en BD en la tabla timerecords, 
                // inserta un registro nuevo, con los ides y la fecha de comienzo
                $.get($(this).attr("data-stop-route"))
                break

        }
    })

    // CLICK BTN RESET (STYKYCHRONO)
    // Actualiza en BD la tabla timerecords,
    // Elimina los registros que no tienen el campo status a 1 (Los que no se han confirmado)

    $("#chrono-reset").click(function() {
        $.get($(this).attr("data-reset-route"))
    })


    //CLICK X (STICKYCHRONO)
    $("#chrono-finish").click(function() {

        // Obtener el id de la tarea actual
        var taskId = $("#sticky-chrono").attr("data-taskid")

        // Peticion al server
        // Marcar los timerecords como finalizado
        $.get($(this).attr("data-finish-route") + "/" + taskId)
    })


});