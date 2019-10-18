$(function() {

    //Evento start para los buttons que encienden el crono
    $("button[id^='b_start_']").click(function() {

        switch ($(this).attr("f")) {
            case "chronoStart":
                chronoStart($(this))
                break

            case "chronoStop":
                chronoStop($(this))
                break

            case "chronoResume":
                chronoResume($(this))
                break
        }
    })

    $("button[id^='b_reset_']").click(function() {
        chronoReset($(this))
    })

});



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
    if (hr < 10) {
        hr = "0" + hr
    }

    $('#chronotime_' + id).html(hr + ":" + min + ":" + sec)

    timerID = setTimeout(
        "chrono(" + id + ")",
        10
    )
}

function chronoStart(e) {

    var id = getId(e)

    //Actualizar interface
    $("#b_start_" + id + " > span.text").text("Stop")

    //Actualizar eventos
    $("#b_start_" + id).attr("f", "chronoStop")

    start = new Date()
    chrono(id)
}

function chronoStop(e) {

    var id = getId(e)

    //Actualizar interface
    $("#b_reset_" + id).removeClass("d-none")
    $("#b_start_" + id + " > span.text").text("Resume")

    //Actualizar eventos
    $("#b_reset_" + id).attr("f", "chronoReset")
    $("#b_start_" + id).attr("f", "chronoResume")

    clearTimeout(timerID)
}

function chronoResume(e) {

    var id = getId(e)

    //Actualizar interface
    $("#b_start_" + id + " > span.text").text("Stop")
    $("#b_reset_" + id).addClass("d-none")

    //Actualizar eventos
    $("#b_start_" + id).attr("f", "chronoStop")

    start = new Date() - diff
    start = new Date(start)
    chrono(id)

}

function chronoReset(e) {

    var id = getId(e)

    //Actualizar interface
    $("#b_reset_" + id).addClass("d-none")
    $('#chronotime_' + id).html("00:00:00")

    //Actualizar eventos
    $("#b_start_" + id).attr("f", "chronoStart")

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