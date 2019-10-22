$(function() {

    //Evento start para los buttons que encienden el crono
    $("#b_start").click(function() {

        var task_id = $("#sticky-chrono").attr("task_id")

        //Esta correcto (la llamada a las funcions parece incorrecta pero es asi porque el script previo chrono.js ha hecho cambios antes)
        switch ($(this).attr("f")) {
            case "chronoStop":
                startCountServer(task_id)
                break

            case "chronoStart":
                stopCountServer(task_id)
                break

            case "chronoResume":
                stopCountServer(task_id)
                break
        }
    })


    //Evento start para los buttons que encienden el crono
    $("button[id^='b_startnew_']").click(function() {
        //get task id 
        var fullId = $(this).attr('id')
        var task_id = fullId.substr(
            fullId.lastIndexOf("_") + 1,
            fullId.length
        )

        startNewTask(task_id)
        location.reload()

    })


    //Evento reset
    $("#b_reset").click(function() {
        var task_id = $("#sticky-chrono").attr("task_id")
        $.get("/ct-reset/" + task_id)
    })

    //Evento start para los buttons que encienden el crono
    $("button[id^='b_done_']").click(function() {

        //get task id 
        var fullId = $(this).attr('id')
        var task_id = fullId.substr(
            fullId.lastIndexOf("_") + 1,
            fullId.length
        )

        setDone(task_id)
    })



});

//peticiones al servidor
function startCountServer(id) {
    $.get("/ct-start/" + id)
}

function stopCountServer() {
    $.get("/ct-stop")
}

//Empezar nueva tarea
function startNewTask(id) {
    $.get("/ct-startnew/" + id)
}


//Empezar nueva tarea
function setDone(id) {
    $.get("/task-done/" + id)
    location.reload()
}