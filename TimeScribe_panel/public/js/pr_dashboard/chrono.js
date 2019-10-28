/**
 * 
 * Script de control (visual) del cronometro, 
 * usado en la vista de Dashboard del proyecto
 * 
 */

$(function() {

    // CLICK SELECT TASK (DOING)
    // Muestra el cronómetro y realiza los cambios visuales relacionados

    $("button[id^='b_doing_select_']").click(function() {

        //Mostrar sticky chrono
        $("#sticky-chrono").removeClass("d-none")
        $("#sticky-chrono").addClass("d-flex")

        //Obtener y añadir el nombre de la tarea en el cronometro
        var id = getId($(this))
        var taskName = $("#t_name_" + id).text();
        $("#task_name").text(taskName);

        //Añadir el id de la tarea como atributo
        $("#sticky-chrono").attr("task_id", id)

        //ocultar el boton de select task
        $(this).addClass("d-none");

        //Actualizar la interface de la tarea seleccionada
        $("#task_" + id + " > div.card").css("background", "yellow")
        $("#task_" + id + " > div.card").addClass("border-dark")

    })


    //CLICK START, STOP, RESUME (STICKYCHRONO)
    $("#b_crono_start").click(function() {

        switch ($(this).attr("function")) {
            case "chronoStart":

                chronoStart()

                // Cambiar funcionalidad a parar cronometro
                $("#b_crono_start").attr("function", "chronoStop")

                // Deshabilitar boton X (Boton de cerrar del STICKY CHRONO)
                $("#x").attr("disabled", true); // Disable close button
                break

            case "chronoStop":

                chronoStop()

                //Actualizar las funcionalidaddes de los botones
                $("#b_crono_reset").attr("function", "chronoReset")
                $("#b_crono_start").attr("function", "chronoResume")

                // Habilitar boton X (Boton de cerrar del STICKY CHRONO)
                $("#x").attr("disabled", false); //enable close button
                break

            case "chronoResume":

                chronoResume()

                //Actualizar las funcionalidaddes de los botones
                $("#b_crono_start").attr("function", "chronoStop")

                // Deshabilitar boton X (Boton de cerrar del STICKY CHRONO)
                $("#x").attr("disabled", true); //disable close button
                break
        }
    })

    //CLICK RESET (STICKYCHRONO)
    $("#b_crono_reset").click(function() {

        chronoReset()

        // Actualizar las funcionalidaddes de los botones
        $("#b_crono_start").attr("function", "chronoStart")

    })

    //CLICK X (STICKYCHRONO)
    $("#x").click(function() {

        // Obtener el id de la tarea actual
        var id = $("#sticky-chrono").attr("task_id")

        // Actualizar la interface de la tarea seleccionada
        $("#task_" + id + " > div.card").css("background", "#fff")
        $("#task_" + id + " > div.card").removeClass("border-dark")

        // Actualizar la interface del cronometro (ocultar)
        $("#sticky-chrono").removeClass("d-flex")
        $("#sticky-chrono").addClass("d-none")

        // Mostrar el boton de seleccionar tarea (de la tarea seleccionada)
        $("#b_doing_select_" + id).removeClass("d-none");

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
    $("#b_crono_start > span.text").text("Stop")

    //Iniciar cronómetro
    start = new Date()
    chrono()
}

/**
 * Pausa el cronometro
 */
function chronoStop() {

    //Actualizar interface
    $("#b_crono_reset").removeClass("d-none")
    $("#b_crono_start > span.text").text("Resume")

    //Pausar cronómetro
    clearTimeout(timerID)
}

/**
 * Continua el funcionamiento del cronometro
 */
function chronoResume() {

    //Actualizar interface
    $("#b_crono_start > span.text").text("Stop")
    $("#b_crono_reset").addClass("d-none")

    start = new Date() - diff
    start = new Date(start)
    chrono()
}

function chronoReset() {

    //Actualizar interface
    $("#b_crono_reset").addClass("d-none")
    $('#chronotime').html("00:00:00")

    start = new Date()
}


/**
 * Obtiene el id del elemento pasado por pararm
 * Se espera que tenga la forma 'elem_id'
 */
// function getId(element) {

//     var fullId = element.attr('id')
//     var task_id = fullId.substr(
//         fullId.lastIndexOf("_") + 1,
//         fullId.length
//     )
//     return task_id
// }