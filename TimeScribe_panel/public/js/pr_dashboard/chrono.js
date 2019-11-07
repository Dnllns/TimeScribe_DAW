/**
 * 
 * Script de control (visual) del cronometro, 
 * usado en la vista de Dashboard del proyecto
 * 
 */

$(function() {

    // CLICK SELECT TASK (DOING)
    // Muestra el cronómetro y realiza los cambios visuales relacionados

    $("i[data-funct='select']").click(function() {


        //OBTENER DATOS QUE VAMOS A USAR
        var taskName = $(this).closest("div[data-chronofunct='taskname']").text()
        var taskElement = $(this).closest("div[data-taskid]")
        var taskId = taskElement.attr("data-taskid")

        //Mostrar sticky chrono
        $("#sticky-chrono").removeClass("d-none")
        $("#sticky-chrono").addClass("d-flex")

        //Añadir el nombre de la tarea en el cronometro
        $("#task_name").text(taskName);

        //Añadir el id de la tarea como atributo
        $("#sticky-chrono").attr("data-taskid", taskId)

        //ocultar el boton de select task
        $(this).addClass("d-none");

        //Actualizar la interface de la tarea seleccionada
        taskElement.find("div.card").css("background", "yellow")
        taskElement.find("div.card").addClass("border-dark")

        // $("#task_" + id + " > div.card").css("background", "yellow")
        // $("#task_" + id + " > div.card").addClass("border-dark")

    })



    //#region Botones StickyChrono

    //#endregion

    //CLICK START 
    $("#chrono-start").click(function() {

        // Iniciar el cronometro
        chronoStart()

        // Deshabilitar y ocultar boton de iniciar
        $("#chrono-start").attr("disabled", true)
        if (!$("#chrono-start").hasClass('d-none')) {
            $("#chrono-start").addClass("d-none")
        }

        // Deshabilitar y ocultar boton de guardar
        $("#chrono-finish").attr("disabled", true)
        if (!$("#chrono-finish").hasClass('d-none')) {
            $("#chrono-finish").addClass("d-none")
        }

        // Habilitar y mostrar boton de pausa
        $("#chrono-stop").attr("disabled", false)
        $("#chrono-stop").removeClass("d-none")

    })

    //CLICK STOP
    $("#chrono-stop").click(function() {

        // Pausar el cronómetro
        chronoStop()

        // Deshabilitar el boton de pausar
        $("#chrono-stop").attr("disabled", true)
        if (!$("#chrono-stop").hasClass('d-none')) {
            $("#chrono-stop").addClass("d-none")
        }


        // Habilitar y mostrar el boton de resume
        $("#chrono-resume").attr("disabled", false) //enable close button
        $("#chrono-resume").removeClass("d-none")

        // Habilitar y mostrar el boton de guardar
        $("#chrono-finish").attr("disabled", false) //enable close button
        $("#chrono-finish").removeClass("d-none")
    })


    //CLICK RESUME
    $("#chrono-resume").click(function() {

        // Retomar el cronómetro
        chronoResume()

        // Habilitar el boton de pausar
        $("#chrono-stop").attr("disabled", false) //enable close button
        $("#chrono-stop").removeClass("d-none")

        // Deshabilitar y ocultar el boton de guardar
        $("#chrono-finish").attr("disabled", true)
        if (!$("#chrono-finish").hasClass('d-none')) {
            $("#chrono-finish").addClass("d-none")
        }

        // Deshabilitar y ocultar el boton de resume
        $("#chrono-resume").attr("disabled", true)
        if (!$("#chrono-resume").hasClass('d-none')) {
            $("#chrono-resume").addClass("d-none")
        }

    })


    //CLICK RESET (STICKYCHRONO)
    $("#chrono-reset").click(function() {

        //Resetear el cronómetrto
        chronoReset()

        // habilitar y mostar el boton de iniciar
        $("#chrono-finish").attr("disabled", false)
        $("#chrono-start").removeClass("d-none")

        // Deshabilitar y ocultar el boton de guardar
        if (!$("#chrono-finish").hasClass('d-none')) {
            $("#chrono-finish").addClass("d-none")
        }

    })

    //CLICK GUARDAR (STICKYCHRONO)
    $("#chrono-finish").click(function() {

        // Obtener el id de la tarea actual
        var id = $("#sticky-chrono").attr("data-taskid")

        // Actualizar la interface de la tarea seleccionada (RESETEAR)
        $("div[data-taskid='" + id + "'] > div.card")
            .css("background", "#fff")
            .removeClass("border-dark")

        // Actualizar la interface del cronometro (ocultar)
        $("#sticky-chrono")
            .removeClass("d-flex")
            .addClass("d-none")

        // Mostrar el boton de seleccionar tarea (de la tarea seleccionada)
        $("div[data-taskid='" + id + "']").find("button[data-funct='select']").removeClass("d-none");

    })

});



/**
 * -----------------------------------------------------------
 * ------------------- FUNCIONES AUXILIARES ------------------
 * -----------------------------------------------------------
 */

var startTime = 0
var start = 0
var end = 0
var diff = 0
var timerID = 0

function chrono() {

    end = new Date()
    diff = end - start
    diff = new Date(diff)

    var sec = diff.getSeconds()
    var min = diff.getMinutes()
    var hr = diff.getHours() - 1

    if (min < 10) {
        min = "0" + min
    }
    if (sec < 10) {
        sec = "0" + sec
    }
    if (hr < 10) {
        hr = "0" + hr
    }

    $('#chronotime').html(hr + ":" + min + ":" + sec)
    timerID = setTimeout("chrono()", 10)

}

/**
 * Inicia el cronometro
 */
function chronoStart() {

    //Actualizar interface
    $("#chrono-start > span.text").text("Stop")

    //Iniciar cronómetro
    start = new Date()
    chrono()
}

/**
 * Pausa el cronometro
 */
function chronoStop() {

    //Actualizar interface
    $("#chrono-reset").removeClass("d-none")
    $("#chrono-start > span.text").text("Resume")

    //Pausar cronómetro
    clearTimeout(timerID)
}

/**
 * Continua el funcionamiento del cronometro
 */
function chronoResume() {

    //Actualizar interface
    $("#chrono-start > span.text").text("Stop")
    $("#chrono-reset").addClass("d-none")

    start = new Date() - diff
    start = new Date(start)
    chrono()
}

function chronoReset() {

    //Actualizar interface
    $("#chrono-reset").addClass("d-none")
    $('#chronotime').html("00:00:00")

    start = new Date()
}