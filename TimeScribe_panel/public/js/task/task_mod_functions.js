$(function() {

    $('#adddev').click(function(event) {
        addDeveloperToList(event)
    });


    $('#devlist').on('click', "a.f-remove", function(event) {
        delDeveloperFromList(event, $(this))
    });

})


function addDeveloperToList(event) {


    // Anular el efecto de click en el enlace
    event.preventDefault();

    var selectedItem = $('#devsselector').children(":selected");

    ajaxAddToList(selectedItem);

    //----- Actualizar interface ---------
    //------------------------------------

    addToList(selectedItem);

    delFromSelect(selectedItem);

    //Si el select esta vacío mostrar un alert
    if ($('#devsselector').html().trim() == "") {

        //Ocultar el selector
        $('#adddevs-selector').css("display", "none");

        //Mostrar mensaje de alerta
        $('#adddevscontainer').append(

            "<div id='adddevs-alert' class='col-12'>" +
            "<div class='alert alert-warning alert-dismissible fade show' role='alert'>" +
            "There isn't more developers availables" +
            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
            "<span aria-hidden='true'>&times;</span>" +
            "</button>" +
            "</div>" +
            "</div>"

        );
    }

}

function delDeveloperFromList(event, element) {

    event.preventDefault();

    if (confirm("Seguro que desea eliminar?")) {

        //Peticion al server
        ajaxDelFromList(element)

        //Añadir el dev eliminado a el select de añadir

        //Comprobar si existe el select
        var selector = $("#adddevs-selector");
        if (selector.css("display") == "none") {
            selector.css("display", "block");
        }

        addToSelect(element)

        //ELiminar de la lista
        delFromList(element)



        //Mensaje de aviso de borrado realizado
        $('#devlist').before(
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


/////////////////////////////////////////////////////////////////

/**
 * Eliminar usuario de la tarea, peticion al servidor
 */
function ajaxDelFromList(element) {

    var ruta = element.attr('data-funct'); // Obtener la tuta
    $.ajax({ url: ruta }); // peticion al servidor

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
    $('#devsselector').append(newElement);

}

function addToList(element) {

    // Obtener el contenido y el id
    var itemContent = element.html();
    var devId = element.attr("value");
    var taskId = $('#taskcard').attr('data-taskid');

    //Anadir a la lista de desarrolladores
    var devListContent = $('#devlist').html();

    $('#devlist').html(devListContent +
        "<li>" +
        "<div class='row'>" +
        "<div class='col data-item' data-id='" + devId + "'>" + itemContent + "</div>" +
        "<div class='col'>" +
        "<a data-id='" + devId + "' data-funct='/task-deldev-bd/" + taskId + "/" + devId + "' href='' class='btn btn-sm text-danger f-remove'>" +
        "<i class='fas fa-trash-alt'></i>" +
        "</a>" +
        "</div>" +
        "</div>" +
        "</li>"
    );

    //var newA = $('#devlist a.f-remove').last();



}


/**
 * Elimina un desarrolador de la lista
 * @param element, es el icono del cubo de basura (un <a> donde se produce el click)
 */
function delFromList(element) {
    // Obtener el elemento contenedor y eliminarlo
    element.closest("li").remove();
}

function delFromSelect(element) {
    element.remove();
}