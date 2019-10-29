/**
 * Script de actualizaciones Ajax
 * ----------------------------------
 * 
 * Hace las peticiones al servidor relacionadas con la vista de project dashboard
 * 
 * 
 */

$(function() {

    //Evento start para los buttons que encienden el crono
    $("#b_crono_start").click(function() {

        var task_id = $("#sticky-chrono").attr("task_id")


        switch ($(this).attr("function")) {

            case "chronoStart":

                // Actualiza en BD la tabla tasks, 
                // inserta en el campo start_date la fecha actual
                $.get("/ct-start/" + task_id)
                break

            case "chronoStop":

                // Inserta en BD en la tabla timerecords, 
                // inserta un registro nuevo, con los ides y la fecha de comienzo
                $.get("/ct-stop")
                break

            case "chronoResume":

                // Actualiza en BD la tabla timerecords, 
                // inserta en el campo finish_date la fecha actual
                $.get("/ct-start/" + task_id)
                break
        }
    })

    // CLICK BTN STARTNEW (TODO)
    // Actualiza en BD la tabla tasks,
    // inserta en el campo start_date la fecha actual

    $("button[id^='b_startnew_']").click(function() {

        $.get("/ct-startnew/" + getId($(this)))
        location.reload()
    })


    // CLICK BTN DONE (DONE)
    // Actualiza en BD la tabla tasks,
    // Pone el valor de status a 2 (DONE)

    $("button[id^='b_done_']").click(function() {

        $.get("/task-done/" + getId($(this)))
        location.reload()
    })



    // CLICK REMOVE TASK (DONE)
    // Actualiza en BD en la tabla tasks,
    // Pone el valor de visible a 0 (Invisible)

    $("button[id^='remove_task_']").click(function() {
        $.get("/task-delete/" + getId($(this)))
        location.reload()
    })



    ////---------------STYKYCHRONO-------------------

    // CLICK BTN RESET (STYKYCHRONO)
    // Actualiza en BD la tabla timerecords,
    // Elimina los registros que no tienen el campo status a 1 (Los que no se han confirmado)

    $("#b_crono_reset").click(function() {

        var task_id = $("#sticky-chrono").attr("task_id")
        $.get("/ct-reset/" + task_id)
    })


    //CLICK X (STICKYCHRONO)
    $("#x").click(function() {

        // Obtener el id de la tarea actual
        var taskId = $("#sticky-chrono").attr("task_id")

        // Peticion al server
        // Marcar los timerecords como finalizado
        $.get("/timerec-set-finish/" + taskId)
    })


});