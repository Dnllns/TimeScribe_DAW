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
        $("li[data-taskid='" + id + "'] .card")
            .css("background", "#fff")
            .removeClass("border-dark")

         $("i[data-funct='select']").removeClass("d-none")


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
        $("li[data-taskid='" + id + "'] .card").css("background", "#fff").removeClass("border-dark")

        // Ocultar chrono
        $("#sticky-chrono").addClass("d-none")
        // Mostrar el boton de seleccionar tarea (de la tarea seleccionada)
        $("li[data-taskid='" + id + "'] .card").find("i[data-funct='select']").removeClass("d-none");

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
    var taskgroupName = taskElement.closest("[data-taskgroup-id]").find("h3").text().trim()
    var taskId = taskElement.attr("data-taskid")

    //Actualizar interface
    //-----------------------

    $("#sticky-chrono").removeClass("d-none") //Mostrar sticky chrono
    $('#chronotime').html("00:00:00") //Resetear tiempo
    // $("#ch-task-name").text(taskName); //Añadir el nombre de la tarea en el cronometro
    $('#ch-task-name').text(taskgroupName + " / " + taskName) //Añadir el nombre del taskgroup en el cronometro
    $("#sticky-chrono").attr("data-current-taskid", taskId) //Añadir el id de la tarea como atributo
        // $("#chrono-start").attr("data-chronofunct", "start") //Añadir la funcion al boton
    toggleElement($("#chrono-start"), "show") // Mostrar el boton de start
    toggleElement($("#chrono-close"), "show") //Habilitar y mostrar el boton de cerrar
    element.addClass("d-none"); //ocultar el boton de select task

    //Actualizar la interface de la tarea seleccionada
    taskElement.find('.card').css("background", "yellow")
    taskElement.find('.card').addClass("border-dark")

}


function moveTask(element, statuss) {

    //Obtener los Datos
    //-----------------

    var taskElement = element.closest("[data-taskid]")
    var name = taskElement.find("[data-name]").text().trim()
    var description = taskElement.find("[data-description]").text().trim()
    var taskId = element.closest("[data-taskid]").attr("data-taskid")

    var f = new Date()
    var dia = f.getDate()
    var mes = (f.getMonth() + 1)
    var ano = f.getFullYear()
    var hora = Math.log10(f.getHours()) < 1 ? "0" + f.getHours() : f.getHours()
    var min =  Math.log10(f.getMinutes()) < 1 ? "0" + f.getMinutes() : f.getMinutes()
    var sec = Math.log10(f.getSeconds()) < 1 ? "0" + f.getSeconds() : f.getSeconds()
    var todayDate =  ano + "-" + dia + "-" + mes + " " + hora +  ":" + min + ":" + sec

    var workedTime, startDate, finishDate

    switch (statuss) {
        case "doing":

            workedTime = "00:00:00"
            startDate = todayDate


            var countTodo = parseInt(taskElement.closest("[data-taskgroup]").find("[data-counttodo]").text().trim())
            var countDoing = parseInt(taskElement.closest("[data-taskgroup]").find("[data-countdoing]").text().trim())

            taskElement.closest("[data-taskgroup]").find("[data-counttodo] strong").text(countTodo-=1)
            taskElement.closest("[data-taskgroup]").find("[data-countdoing] strong").text(countDoing+=1)

            break;

        case "done":

            workedTime = taskElement.find("[data-workedtime]").text()
            startDate = taskElement.find("[data-startdate]").text()
            finishDate = todayDate


            var countDoing = parseInt(taskElement.closest("[data-taskgroup]").find("[data-countdoing]").text().trim())
            var countDone = parseInt(taskElement.closest("[data-taskgroup]").find("[data-countdone]").text().trim())

            taskElement.closest("[data-taskgroup]").find("[data-countdoing] strong").text(countDoing-=1)
            taskElement.closest("[data-taskgroup]").find("[data-countdone] strong").text(countDone+=1)

            break;
    }

    var doneButtons = "<i data-funct='delete' data-ajax-route='/task-setdeleted-bd/" + taskId + "' class='far fa-trash-alt text-white btn-sm' data-tooltip='tooltip' data-placement='bottom' data-original-title='Remove task'></i>"

    var doingButtons = "<i data-funct='select' data-chronofunct='start' class='fas fa-hourglass-start text-white btn-sm' data-tooltip='tooltip' data-placement='bottom' title='' data-original-title='Select task'></i>"+
        "<i data-funct='done' data-ajax-route='/task-setdone-bd/" + taskId + "' class='far fa-check-circle text-white btn-sm' data-tooltip='tooltip' data-placement='bottom' title='' data-original-title='Set done'></i>"

    var doneData = "<div class='col-12'>"+ "<strong>Finish date:</strong>"+"</div>"+"<div class='col-12'>"+ finishDate +"</div>"

    //Generar el nuevo elemento
    var newTask =
    "<li data-taskid='" + taskId + "'>"+
        "<div class='card mb-2'>"+

            "<div data-name='" + name +"' class='card-header col-12 py-1 px-2 text-uppercase bg-dark text-doing'>"+
                "<strong>" + name + "</strong>"+
                "<div class='float-right'>"+
                    "<a data-togglebuttons data-toggle='collapse' href='div[data-toggleid=\"" + taskId +"\"]' role='button' aria-expanded='true'>"+
                        "<i data-funct='' class='fas fa-tools'></i>"+
                    "</a>"+
                "</div>"+
            "</div>"+

            "<div class='card-body col-12 p-2'>"+

                "<div data-toggleid='"+ taskId + "' class='bg-dark rounded collapse'>"+
                    (statuss == "done" ? doneButtons : doingButtons) +
                    "<i data-funct='view' class='fas fa-chevron-down text-white btn-sm' data-tooltip='tooltip' data-placement='bottom' title='' data-toggle='collapse' data-target='#task-data-"+ taskId +"' data-original-title='View task'></i>"+
                "</div>"+

                "<div data-description class='row p-0'>"+
                    "<div class='col-12'><strong>Description:</strong></div>"+
                    "<div data-description class='col-12'>" + description + "</div>"+
                "</div>"+

                "<div id='task-data-" + taskId +"' class='row p-0 collapse'>"+

                    "<div class='col-12'>"+
                        "<strong>Worked time:</strong>"+
                    "</div>"+
                    "<div data-workedtime class='col-12'>"+ workedTime +"</div>"+

                    "<div class='col-12'>"+
                        "<strong>Start date:</strong>"+
                    "</div>"+
                    "<div data-startdate class='col-12'>"+ startDate +"</div>"+

                    (statuss == "done" ? doneData : "") +

                "</div>"+
            "</div>"+
        "</div>"+
    "</li>"


    //Añadirlo a la columna de doing
    element.closest("[data-taskgroup]").find("[data-"+ statuss +"] ul").append(newTask)

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
