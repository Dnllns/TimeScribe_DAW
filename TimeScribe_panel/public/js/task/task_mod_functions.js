$(function() {

    $('#workgroup-devs-container').on('click', "a.btn", function(event) {
        addDeveloperToList(event)
    })


    $('#project-devs-container').on('click', "a.f-remove", function(event) {
        delDeveloperFromList(event, $(this))

        window.setTimeout(
            function() {
                $("#project-devs-container .alert.alert-success").fadeTo(500, 0).slideUp(
                    500,
                    function() { $(this).remove() })
            },
            2000
        )

        if ($('#dev-list ul li').length == 0) {

            $('#project-devs-container').append(

                "<div id='alert-dev-list'>" +
                "<div class='alert alert-warning alert-dismissible fade show' role='alert'>" +
                "Currently no developer has been added." +
                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                "<span aria-hidden='true'>×</span>" +
                "</button>" +
                "</div>" +
                "</div>"

            )
        }

    })







})

//-----------------------------------------------------------------------
//
//                             AÑADIR A LA LISTA
//                              ---------------
//
//-----------------------------------------------------------------------


// #region add to list


function addDeveloperToList(event) {


    // Anular el efecto de click en el enlace
    event.preventDefault()

    var selectedItem = $('#select-devs select').children(":selected")

    ajaxAddToList(selectedItem)

    //----- Actualizar interface ---------
    //------------------------------------


    addPrepareInterface() // Preparar interface
    addToList(selectedItem)
    delFromSelect(selectedItem)

    //Si el select esta vacío mostrar un alert
    if ($('#select-devs select').has('option').length == 0) {
        selectShowAlert()
    }

}

function selectShowAlert() {

    //Eliminar el selector y el boton
    $("#select-devs").remove()

    //Mostrar mensaje de alerta
    $('#workgroup-devs-container').append(

        "<div id='alert-select-devs'>" +
        "<div class='alert alert-warning alert-dismissible fade show' role='alert'>" +
        "There isn't more developers availables" +
        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
        "<span aria-hidden='true'>&times;</span>" +
        "</button>" +
        "</div>" +
        "</div>"

    );
}

function ajaxAddToList(element) {

    //Obtener el id del dev seleccionado
    var devId = element.attr("value");

    // Obtener la ruta de la peticion
    var ruta = $('#adddev').attr('data-funct');
    ruta = ruta.replace('devId', devId);

    // Peticion al server
    $.ajax({ url: ruta });

}

function addPrepareInterface() {

    var devlist = $("#dev-list");

    //Si la lista no existe se crea
    if (devlist.length == 0) {

        $("#project-devs-container").append(
            "<div id='dev-list'><ul></ul></div>"
        );
    }

    //Si hay un mensaje de alerta se elimina
    $("#alert-dev-list").remove();

}

function addToList(element) {

    // Obtener el contenido y el id
    var itemContent = element.html();
    var devId = element.attr("value");
    var taskId = $('#taskcard').attr('data-taskid');

    //Anadir a la lista de desarrolladores
    $('#dev-list ul').append(
        "<li class='list-group-item'>" +
        "<div class='row'>" +
        "<div class='col data-item' data-id='" + devId + "'>" + itemContent + "</div>" +
        "<div class='col'>" +
        "<a data-id='" + devId + "' data-funct='/task-deldev-bd/" + taskId + "/" + devId + "' href='' class='btn btn-sm text-warning f-remove'>" +
        "<i class='fas fa-trash-alt'></i>" +
        "</a>" +
        "</div>" +
        "</div>" +
        "</li>"
    );

}

function delFromSelect(element) {
    element.remove();
}

// #endregion


//-----------------------------------------------------------------------
//
//                             ELIMINAR DE LA LISTA
//                              ------------------
//
//-----------------------------------------------------------------------


function delDeveloperFromList(event, element) {

    event.preventDefault();

    if (confirm("Seguro que desea eliminar?")) {

        //Peticion al server
        ajaxDelFromList(element)


        //Interface
        delPrepareInterface()


        //Añadir el dev eliminado a el select de añadir
        addToSelect(element)

        //ELiminar de la lista
        delFromList(element)



        //Mensaje de aviso de borrado realizado
        $('#dev-list').before(
            "<div class='col-12 mt-2' >" +
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>" +
            "The develloper has been deleted" +
            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
            "<span aria-hidden='true'>&times;</span>" +
            "</button>" +
            "</div>" +
            "</div>"
        );
    }
}



/**
 * Eliminar usuario de la tarea, peticion al servidor
 */
function ajaxDelFromList(element) {

    var ruta = element.attr('data-funct'); // Obtener la tuta
    $.ajax({ url: ruta }); // peticion al servidor

}




/**
 * Añade un desarrollador a el select
 */
function addToSelect(element) {

    //obtener el elemento contenedor
    var itemContainer = element.closest('div').siblings()[0];

    //Extraer los datos
    var itemContent = itemContainer.innerText; //Obtener el contenido del elemento
    var itemId = itemContainer.getAttribute('data-id') //Obtener el id

    //Crear el nuevo elemento y añadirlo al select
    var newElement = "<option value='" + itemId + "'>" + itemContent + "</option>";
    $('#select-devs select').append(newElement);

}




/**
 * Elimina un desarrolador de la lista
 * @param element, es el icono del cubo de basura (un <a> donde se produce el click)
 */
function delFromList(element) {
    // Obtener el elemento contenedor y eliminarlo
    element.closest("li").remove();
}


function delPrepareInterface() {

    //Si el select y el boton no exiten se añaden
    if ($("#select-devs").length == 0) {

        $("#workgroup-devs-container").append(
            "<div id='select-devs' class='row'>" +
            "<div class='col-6'>" + "<select class='browser-default custom-select'></select>" + "</div>" +
            "<div class='col my-auto'>" + "<a id='adddev' class='btn btn-sm btn-primary float-right' data-funct='/task-adddev-bd/1/devId' href>Add selected</a>" + "</div>" +
            "</div>"

        )
    }

    //Eliminar el alert
    $("#alert-select-devs").remove()

}