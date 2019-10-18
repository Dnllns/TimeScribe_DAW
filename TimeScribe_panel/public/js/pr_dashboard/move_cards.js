$(function() {

    //Evento start para los buttons que encienden el crono
    $("button[id^='b_startnew_']").click(function() {
        startNewTask($(this))
    })

});




function todoDoing(e) {

    var id = getId(e)

    $("#todo_task").after()


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


function makeTask() {


}