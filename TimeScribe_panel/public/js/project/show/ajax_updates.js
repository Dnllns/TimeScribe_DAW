/**
 * Script de actualizaciones Ajax
 * ----------------------------------
 *
 * Hace las peticiones al servidor relacionadas con la vista de project dashboard
 *
 *
 */

$(function() {


    botonesTarea();

    botonesChrono();


});


function botonesTarea() {

    // CLICK BTN STARTNEW (TODO)
    // Actualiza en BD la tabla tasks,
    // inserta en el campo start_date la fecha actual

    // CLICK BTN DONE (DONE)
    // Actualiza en BD la tabla tasks,
    // Pone el valor de status a 2 (DONE)

    // CLICK REMOVE TASK (DONE)
    // Actualiza en BD en la tabla tasks,
    // Pone el valor de visible a 0 (Invisible)

    $("i[data-funct]").click(function() {

        var funct = $(this).attr("data-funct")

        if (
            funct == "done" ||
            funct == "start" ||
            funct == "delete"
        ) {

            $.get($(this).attr('data-ajax-route')) // Peticion a servidor

            // ACTUALIZAR INTERFACE
            //---------------------
            // DE MOMENTO reload Lo suyo seria Ajax para añadir los task a su nuevo espacio de estado (DOING, DONE)
            //location.reload()

        }


    })


}


function botonesChrono() {

    //Peticion ajax de los botones que interactuan con bd
    $("#sticky-chrono button").click(function() {

        var ruta = $(this).attr("data-ajax")
        var elementId = $(this).attr('id');

        if (
            elementId == "chrono-start" ||
            elementId == "chrono-reset" ||
            elementId == "chrono-finish" ||
            elementId == "chrono-resume"
        ) {

            var taskId = $("#sticky-chrono").attr("data-current-taskid")
            ruta += "/" + taskId

        }

        $.get(ruta) //Peticion al server

    })

    // Actualizr el tiempo trabajado de la tarea
    $("#chrono-finish").click(function() {

        //Obtener el id de la tarea
        var taskId = $("#sticky-chrono").attr("data-current-taskid")

        //Obtener el tiempo del servidor
        var ajaxRoute = "/ct-getworkedtime/" + taskId



        // var xmlhttp = new XMLHttpRequest()
        // xmlhttp.onreadystatechange = function() {
        //     if (this.readyState == 4 && this.status == 200) {
        //         var response = JSON.parse(this.responseText);

        //         //Actualizar interface (Añadir el tiempo obtenido del server)
        //         $("div[data-taskid='" + taskId + "']").find("div[data-workedtime]").innerText(response)

        //         // document.getElementById("demo").innerHTML = myObj.name;
        //     }
        // }
        // xmlhttp.open("GET", ajaxRoute, true)
        // xmlhttp.send()


        $.get(ajaxRoute, function(data, status) {

            if (status == "success") {


                var time = data.split('"')

                $("div[data-taskid='" + taskId + "']").find("div[data-workedtime]").html(
                    "<i class='fas fa-business-time mr-1'></i>" + time[1]
                )
            }
        })




    })



    // CLICK BTN RESET (STYKYCHRONO)
    // Actualiza en BD la tabla timerecords,
    // Elimina los registros que no tienen el campo status a 1 (Los que no se han confirmado)

    // $("#chrono-reset").click(function() {
    //     $.get($(this).attr("data-reset-route"))
    // })


    //CLICK X (STICKYCHRONO)
    // $("#chrono-finish").click(function() {

    //     // Obtener el id de la tarea actual
    //     var taskId = $("#sticky-chrono").attr("data-taskid")

    //     // Peticion al server
    //     // Marcar los timerecords como finalizado
    //     $.get($(this).attr("data-finish-route") + "/" + taskId)
    // })
}