/**
 * Script de actualizaciones Ajax
 * ----------------------------------
 *
 * Hace las peticiones al servidor relacionadas con la vista de project dashboard
 *
 *
 */

$(function() {


    botonesTarea();

    botonesChrono();


});


function botonesTarea() {

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


        switch ($(this).attr("data-funct")) {

            case "done":
            case "start":
            case "delete":

                $.get($(this).attr('data-ajax-route')) // Peticion a servidor

                // ACTUALIZAR INTERFACE
                //---------------------
                // DE MOMENTO reload Lo suyo seria Ajax para añadir los task a su nuevo espacio de estado (DOING, DONE)
                location.reload()

                break

        }

    })


}


function botonesChrono() {

    //Evento start para los buttons que encienden el crono
    $("#chrono-start").click(function() {

        var currentFunction = $(this).attr("data-chronofunct")
        var taskId = $("#sticky-chrono").attr("data-current-taskid")
        var ruta

        switch (currentFunction) {

            case "start" || "resume":
                // Actualiza en BD la tabla tasks,
                // inserta en el campo start_date la fecha actual

                ruta = $("#chrono-start").attr("data-start-route") + "/" + taskId
                break

            case "stop":
                // Inserta en BD en la tabla timerecords,
                // inserta un registro nuevo, con los ides y la fecha de comienzo
                ruta = $("#chrono-reset").attr("data-reset-route") + "/" + taskId
                break

        }

        $.get(ruta) //Peticion al server

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
}