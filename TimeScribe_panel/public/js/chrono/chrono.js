var startTime = 0
var start = 0
var end = 0
var diff = 0
var timerID = 0

function chrono(id) {
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

    $('#chronotime_' + id).html(hr + ":" + min + ":" + sec)

    timerID = setTimeout(
        "chrono(" + id + ")",
        10
    )
}

/**
 * Iniciar el cronometro;
 * Actualiza el texto del boton de StartStopResume a Stop
 * Añade el evento chronoStop al boton de StartStopResume
 * @param {*} event 
 */
function chronoStart(event) {

    event.preventDefault()
    var id = getId(event) //Obtener el id

    //Actualizar interface
    $("#b_start_" + id + " > span.text").text("Stop")

    //Actualizar eventos
    $("#b_start_" + id).attr("onclick", "chronoStop(event)")

    start = new Date()
    chrono(id)
}

/**
 * Pausar el cronómetro
 * @param {} event 
 */
function chronoStop(event) {

    event.preventDefault()
    var id = getId(event) //Obtener el id

    //Actualizar interface
    $("#b_reset_" + id).removeClass("d-none")
    $("#b_start_" + id + " > span.text").text("Resume")

    //Actualizar eventos
    $("#b_reset_" + id).attr("onclick", "chronoReset(event)")
    $("#b_start_" + id).attr("onclick", "chronoResume(event)")

    clearTimeout(timerID)
}

function chronoResume(event) {

    event.preventDefault()
    var id = getId(event) //Obtener el id

    //Actualizar interface
    $("#b_start_" + id + " > span.text").text("Stop")
    $("#b_reset_" + id).addClass("d-none")

    //Actualizar eventos
    $("#b_start_" + id).attr("onclick", "chronoStop(event)")

    start = new Date() - diff
    start = new Date(start)
    chrono(id)

}

function chronoReset(event) {

    event.preventDefault()
    var id = getId(event)

    //Actualizar interface
    $("#b_reset_" + id).addClass("d-none")
    $('#chronotime_' + id).html("0:00:00")

    //Actualizar eventos
    $("#b_start_" + id).attr("onclick", "chronoStart(event)")

    start = new Date()
}



function getId(event) {

    var fullId = event.target.parentElement.id
    var id = fullId.substr(
        fullId.lastIndexOf("_") + 1,
        fullId.length
    )

    return id;
}