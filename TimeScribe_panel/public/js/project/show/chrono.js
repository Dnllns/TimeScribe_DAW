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
        seleccionarTarea($(this))
    })




    //-------------------------------------------------
    // STICKY CHRONO

    // #region Botones StickyChrono

    //CLICK START
    $("#chrono-start").click(function() {

        // Iniciar el cronometro
        // ------------------------
        chronoStart()

        // Actualizar interface
        // ---------------------

        //Ocultar todos los botones menos el de parar
        toggleElement($("#chrono-start"), "hide")
        toggleElement($("#chrono-resume"), "hide")
        toggleElement($("#chrono-reset"), "hide")
        toggleElement($("#chrono-finish"), "hide")
        toggleElement($("#chrono-close"), "hide")

        toggleElement($("#chrono-stop"), "show") // Habilitar y mostrar el boton de parar

    })

    //CLICK STOP
    $("#chrono-stop").click(function() {

        // Pausar el cronómetro
        // ------------------------
        chronoStop()

        // Actualizar interface
        // ----------------------

        // Mostrar todos los botones menos el de start y stop
        toggleElement($("#chrono-start"), "hide") //Deshabilitar y ocultar el boton de start
        toggleElement($("#chrono-stop"), "hide") //Deshabilitar y ocultar el boton de stop

        toggleElement($("#chrono-resume"), "show")
        toggleElement($("#chrono-reset"), "show")
        toggleElement($("#chrono-finish"), "show")
        toggleElement($("#chrono-close"), "show")



    })


    //CLICK RESUME
    $("#chrono-resume").click(function() {

        // Retomar el cronómetro
        // ------------------------
        chronoResume()

        // Actualizar interface
        // ----------------------

        //Ocultar todos los botones menos el de parar
        toggleElement($("#chrono-start"), "hide")
        toggleElement($("#chrono-resume"), "hide")
        toggleElement($("#chrono-reset"), "hide")
        toggleElement($("#chrono-finish"), "hide")
        toggleElement($("#chrono-close"), "hide")

        toggleElement($("#chrono-stop"), "show") //Habilitar y mostrar el boton de stop

    })

    //CLICK RESET (STICKYCHRONO)
    $("#chrono-reset").click(function() {

        // Resetear el cronómetrto
        // ---------------------
        chronoReset()

        // Actualizar interface
        // ----------------------

        toggleElement($("#chrono-resume"), "hide")
        toggleElement($("#chrono-reset"), "hide")
        toggleElement($("#chrono-finish"), "hide")
        toggleElement($("#chrono-stop"), "hide")


        toggleElement($("#chrono-start"), "show") //Habilitar y mostrar el boton de start
        toggleElement($("#chrono-close"), "show") //Habilitar y mostrar el boton de cerrar


    })

    //CLICK GUARDAR (STICKYCHRONO)
    $("#chrono-finish").click(function() {


        // Obtener Datos
        //------------------
        var id = $("#sticky-chrono").attr("data-current-taskid") //Id de la tarea actual

        //Resetear el cronómetro
        //-------------------------
        chronoReset()

        // Actualizar la interface 
        //-------------------------
        // Resetear la tarea seleccionada
        $("div[data-taskid='" + id + "']")
            .css("background", "#fff")
            .removeClass("border-dark")

        // Ocultar los botones    
        toggleElement($("#chrono-resume"), "hide")
        toggleElement($("#chrono-reset"), "hide")
        toggleElement($("#chrono-finish"), "hide")
        toggleElement($("#chrono-stop"), "hide")
        toggleElement($("#chrono-start"), "hide")
        toggleElement($("#chrono-close"), "hide")

        $("#sticky-chrono").addClass("d-none") //Ocultar cronometro

        // Mostrar el boton de seleccionar tarea (de la tarea seleccionada)
        $("div[data-taskid='" + id + "']").find("i[data-funct='select']").removeClass("d-none");

    })


    //CLICK CLOSE (STICKYCHRONO)
    $("#chrono-close").click(function() {


        // Obtener Datos
        //------------------
        var id = $("#sticky-chrono").attr("data-current-taskid") // Obtener el id de la tarea actual

        //Resetear el cronómetro
        //-------------------------
        chronoReset()


        // Actualizar la interface 
        //-------------------------

        // Resetear la interface la tarea seleccionada 
        $("div[data-taskid='" + id + "']")
            .css("background", "#fff")
            .removeClass("border-dark")
        $("#sticky-chrono").addClass("d-none") // Ocultar chrono
            // Mostrar el boton de seleccionar tarea (de la tarea seleccionada)
        $("div[data-taskid='" + id + "']").find("i[data-funct='select']").removeClass("d-none");

        //Ocultar lops botones
        toggleElement($("#chrono-resume"), "hide")
        toggleElement($("#chrono-reset"), "hide")
        toggleElement($("#chrono-finish"), "hide")
        toggleElement($("#chrono-stop"), "hide")
        toggleElement($("#chrono-start"), "hide")
        toggleElement($("#chrono-close"), "hide")

    })

    // #endregion



})

function toggleElement(element, action) {


    switch (action) {
        case "show":

            // habilitar y mostar 
            element.attr("disabled", false)
            element.removeClass("d-none")

            break

        case "hide":

            // Deshabilitar y ocultar el boton
            if (!element.hasClass('d-none')) {
                element.addClass("d-none")
            }
            element.attr("disabled", true)

            break
    }

}



// TASK CARD
//-----------------

// #region taskcard

function seleccionarTarea(element) {

    //OBTENER DATOS QUE VAMOS A USAR
    //-------------------------------------
    var taskElement = element.closest("[data-taskid]")
    var taskName = taskElement.find("[data-name]").text().trim()
    var taskgroupName = taskElement.closest("[data-taskgroup-id]").find("p[data-taskgroup-name]").text().trim()
    var taskId = taskElement.attr("data-taskid")

    //Actualizar interface
    //-----------------------

    $("#sticky-chrono").removeClass("d-none") //Mostrar sticky chrono
    $('#chronotime').html("00:00:00") //Resetear tiempo 
    $("#ch-task-name").text(taskName); //Añadir el nombre de la tarea en el cronometro
    $('#ch-taskgroup-name').text(taskgroupName) //Añadir el nombre del taskgroup en el cronometro
    $("#sticky-chrono").attr("data-current-taskid", taskId) //Añadir el id de la tarea como atributo
        // $("#chrono-start").attr("data-chronofunct", "start") //Añadir la funcion al boton
    toggleElement($("#chrono-start"), "show") // Mostrar el boton de start
    toggleElement($("#chrono-close"), "show") //Habilitar y mostrar el boton de cerrar
    element.addClass("d-none"); //ocultar el boton de select task
    //Actualizar la interface de la tarea seleccionada
    taskElement.css("background", "yellow")
    taskElement.addClass("border-dark")

}

// #endregion




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

    //Iniciar cronómetro
    start = new Date()
    chrono()
}

/**
 * Pausa el cronometro
 */
function chronoStop() {

    //Pausar cronómetro
    clearTimeout(timerID)
}

/**
 * Continua el funcionamiento del cronometro
 */
function chronoResume() {

    start = new Date() - diff
    start = new Date(start)
    chrono()
}

function chronoReset() {

    $('#chronotime').html("00:00:00")
    start = new Date()
}