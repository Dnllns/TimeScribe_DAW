/**
 *
 * Script de control (visual) del cronometro,
 * usado en la vista de Dashboard del proyecto
 *
 */

$(function() {

    // CLICK SELECT TASK (DOING)
    // Muestra el cronómetro y realiza los cambios visuales relacionados

    $("[data-taskgroup]").on("click", "i[data-funct='select']", function() {
        seleccionarTarea($(this))

    })


    $("[data-taskgroup]").on("click", "i[data-funct='start']", function() {
        //Mover la tarea a Doing
        moveTask($(this), "doing")
    })


    $("[data-taskgroup]").on("click", "i[data-funct='done']", function() {
        //Mover la tarea a Doing
        moveTask($(this), "done")
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


function moveToDoing(element) {

    //Obtener los Datos
    //-----------------

    var taskElement = element.closest("[data-taskid]")
    var name = taskElement.find("[data-name]").attr("data-name")
    var description = taskElement.find("[data-description]").text()
    var taskId = element.closest("[data-taskid]").attr("data-taskid")

    //Obtener Fecha y hora
    var f = new Date()
    var dia = f.getDate()
    var mes = (f.getMonth() + 1)
    var ano = f.getFullYear()
    var hora = Math.log10(f.getHours()) < 1 ? "0" + f.getHours() : f.getHours()
    var min =  Math.log10(f.getMinutes()) < 1 ? "0" + f.getMinutes() : f.getMinutes()
    var sec = Math.log10(f.getSeconds()) < 1 ? "0" + f.getSeconds() : f.getSeconds()
    var date =  ano + "-" + dia + "-" + mes + " " + hora +  ":" + min + ":" + sec


    //Generar el nuevo elemento
    var newTask =
        "<div data-taskid='" + taskId + "' class='col-sm-12 mx-auto'>" +
        "<div class='card border-fat shadow mb-2'>" +
        "<div class='row m-2'>" +
        "<div class='col-md-11 p-0 no-gutters'>" +
        "<div data-name='" + name + "' class='font-weight-bold text-primary text-uppercase mb-1'>" + name + "</div>" +
        "<div class='font-weight-bold mb-1'>" + description + "</div>" +
        "<div id='task-data-" + taskId + "' class='row text-xs collapse show' >" +
        "<div data-workedtime class='col-12 m-1' data-tooltip='tooltip' data-placement='bottom' data-original-title='Worked time'><i class='fas fa-business-time mr-1'></i>00:00:00</div>" +
        "<div class='col-12 m-1' data-tooltip='tooltip' data-placement='bottom' data-original-title='Start date'>" +
        "<i class='fas fa-calendar-day mr-1'></i>" + date +
        "</div>" +
        "</div>" +
        "</div>" +
        "<div class='col-md-1 p-0 d-flex flex-column align-items-center'>" +
        "<i data-funct='view' class='far fa-eye text-info pb-1' data-tooltip='tooltip' data-placement='bottom' data-toggle='collapse' data-target='#task-data-" + taskId + "' data-original-title='View task' aria-expanded='true'></i>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>"

    //Añadirlo a la columna de doing
    element.closest("[data-taskgroup]").find("[data-doing]").append(newTask)

    //Eliminarlo de todo
    element.closest("[data-taskid]").remove()



}


function moveTask(element, statuss) {

    //Obtener los Datos
    //-----------------

    var taskElement = element.closest("[data-taskid]")
    var name = taskElement.find("[data-name]").attr("data-name")
    var description = taskElement.find("[data-description]").text()
    var taskId = element.closest("[data-taskid]").attr("data-taskid")

    //Obtener Fecha y hora
    var f = new Date()
    var dia = f.getDate()
    var mes = (f.getMonth() + 1)
    var ano = f.getFullYear()
    var hora = Math.log10(f.getHours()) < 1 ? "0" + f.getHours() : f.getHours()
    var min =  Math.log10(f.getMinutes()) < 1 ? "0" + f.getMinutes() : f.getMinutes()
    var sec = Math.log10(f.getSeconds()) < 1 ? "0" + f.getSeconds() : f.getSeconds()
    var date =  ano + "-" + dia + "-" + mes + " " + hora +  ":" + min + ":" + sec


    var doneButtons = "<i data-funct='delete' data-ajax-route='/task-setdeleted-bd/" + taskId + "' class='far fa-trash-alt text-danger pb-1' data-tooltip='tooltip' data-placement='bottom' data-original-title='Remove task'></i>"

    var doingButtons = "<i data-funct='select' data-chronofunct='start' class='fas fa-hourglass-start text-warning pb-1' data-tooltip='tooltip' data-placement='bottom' data-original-title='Select task'></i>" +
    "<i data-funct='done' data-ajax-route='task-setdone-bd/" + taskId + "' class='far fa-check-circle text-success pb-1' data-tooltip='tooltip' data-placement='bottom' data-original-title='Set done'></i>"


    //Generar el nuevo elemento
    var newTask =
        "<div data-taskid='" + taskId + "' class='col-sm-12 mx-auto'>" +
        "<div class='card border-fat shadow mb-2'>" +
        "<div class='row m-2'>" +
        "<div class='col-md-11 p-0 no-gutters'>" +
        "<div data-name='" + name + "' class='font-weight-bold text-primary text-uppercase mb-1'>" + name + "</div>" +
        "<div class='font-weight-bold mb-1'>" + description + "</div>" +
        "<div id='task-data-" + taskId + "' class='row text-xs collapse show' >" +
        "<div data-workedtime class='col-12 m-1' data-tooltip='tooltip' data-placement='bottom' data-original-title='Worked time'><i class='fas fa-business-time mr-1'></i>00:00:00</div>" +
        "<div class='col-12 m-1' data-tooltip='tooltip' data-placement='bottom' data-original-title='Start date'>" +
        "<i class='fas fa-calendar-day mr-1'></i>" + date +
        "</div>" +
        "</div>" +
        "</div>" +
        "<div class='col-md-1 p-0 d-flex flex-column align-items-center'>" +
        "<i data-funct='view' class='far fa-eye text-info pb-1' data-tooltip='tooltip' data-placement='bottom' data-toggle='collapse' data-target='#task-data-" + taskId + "' data-original-title='View task' aria-expanded='true'></i>" +
        (statuss == "done" ? doneButtons : doingButtons) +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>"

    //Añadirlo a la columna de doing
    element.closest("[data-taskgroup]").find("[data-"+ statuss +"]").append(newTask)

    //Eliminarlo de todo
    element.closest("[data-taskid]").remove()



}

// #endregion




/**
 * -----------------------------------------------------------
 * ------------------- FUNCIONES AUXILIARES ------------------
 * -----------------------------------------------------------
 */


// #region Chrono

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



// #endregion
