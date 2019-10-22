$(function() {

    //ENABLE TOOLTIPS
    $('[data-toggle="tooltip"]').tooltip()

    //CLICK SELECT TASK
    $("button[id^='b_select_']").click(function() {

        //mostrar sticky chrono
        $("#sticky-chrono").removeClass("d-none")
        $("#sticky-chrono").addClass("d-flex")


        //Actualizar el nombre de la tarea

        var id = getId($(this))
        var taskName = $("#t_name_" + id).text();
        $("#task_name").text(taskName);

        //Añadir el id de la tarea como atributo
        $("#sticky-chrono").attr("task_id", id)

        $("#task_" + id + " > div.card").css("background", "yellow")
        $("#task_" + id + " > div.card").addClass("border-dark")

        //ocultar el boton de select task
        $(this).addClass("d-none");



    })

    //Evento start para los buttons que encienden el crono
    $("#b_start").click(function() {

        switch ($(this).attr("f")) {
            case "chronoStart":

                chronoStart() //start chrono
                $("#x").attr("disabled", true); //disable close button

                break

            case "chronoStop":
                chronoStop()
                $("#x").attr("disabled", false); //enable close button
                break

            case "chronoResume":
                chronoResume()
                $("#x").attr("disabled", true); //disable close button
                break
        }
    })

    $("#b_reset").click(function() {
        chronoReset()
    })

    $("#x").click(function() {

        var id = $("#sticky-chrono").attr("task_id")
        $("#task_" + id + " > div.card").css("background", "#fff")

        $("#task_" + id + " > div.card").removeClass("border-dark")
        $("#sticky-chrono").removeClass("d-flex")
        $("#sticky-chrono").addClass("d-none")
        $("#b_select_" + id).removeClass("d-none");


    })



});



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

function chronoStart() {


    //Actualizar interface
    $("#b_start > span.text").text("Stop")

    //Actualizar eventos
    $("#b_start").attr("f", "chronoStop")

    //Iniciar cronómetro
    start = new Date()
    chrono()
}

function chronoStop() {


    //Actualizar interface
    $("#b_reset").removeClass("d-none")
    $("#b_start > span.text").text("Resume")

    //Actualizar eventos
    $("#b_reset").attr("f", "chronoReset")
    $("#b_start").attr("f", "chronoResume")

    //Pausar cronómetro
    clearTimeout(timerID)
}

function chronoResume() {


    //Actualizar interface
    $("#b_start > span.text").text("Stop")
    $("#b_reset").addClass("d-none")

    //Actualizar eventos
    $("#b_start").attr("f", "chronoStop")

    start = new Date() - diff
    start = new Date(start)
    chrono()

}

function chronoReset() {


    //Actualizar interface
    $("#b_reset").addClass("d-none")
    $('#chronotime').html("00:00:00")

    //Actualizar eventos
    $("#b_start").attr("f", "chronoStart")

    start = new Date()
}

function getId(e) {
    var fullId = e.attr('id')
    var id = fullId.substr(
        fullId.lastIndexOf("_") + 1,
        fullId.length
    )
    return id
}