$(function() {

    //Evento start para los buttons que encienden el crono
    $("button[id^='b_start_']").click(function() {

        switch ($(this).attr("f")) {
            case "chronoStart":
                startCountServer($(this))
                break

            case "chronoStop":
                stopCountServer($(this))
                break

            case "chronoResume":
                startCountServer($(this))
                break
        }
    })


    //Evento start para los buttons que encienden el crono
    $("button[id^='b_startnew_']").click(function() {
        startNewTask($(this))
    })

});

//peticiones al servidor
function startCountServer(e) {
    var id = getId(e)
    $.get("/ct-start/" + id)
}

function stopCountServer() {
    $.get("/ct-stop")
}

//Empezar nueva tarea
function startNewTask(e) {
    var id = getId(e)
    $.get("/ct-startnew/" + id)
}


//Codigo auxiliar
function getId(e) {
    var fullId = e.attr('id')
    var id = fullId.substr(
        fullId.lastIndexOf("_") + 1,
        fullId.length
    )
    return id
}