$(function() {


    // LISTA ELIMINAR
    //---------------
    $('#dev-config-container').on('click', "#dev-list a.f-remove", function(event) {

        // Eliminar el developer de la lista
        delDeveloperFromList(event, $(this))

        // Ocultar el alert de aviso de eliminacion
        window.setTimeout(
            function() {
                $("#dev-config-container .alert.alert-success").fadeTo(500, 0).slideUp(
                    500,
                    function() { $(this).remove() })
            },
            5000
        )



    })

    // LISTA AÑADIR
    //--------------
    $('#dev-config-container').on('click', "#add-devs a.btn", function(event) {
        addDeveloperToList(event)
    })


})

// -----------------------------------------------------------
//                      LISTA ELIMINAR
// -----------------------------------------------------------
// #region ListaEliminar

function delDeveloperFromList(event, element) {

    event.preventDefault();

    if (confirm("Seguro que desea eliminar?")) {


        ajaxDelFromList(element) //Peticion al server
        delPrepareInterface() //Preparar interface para hacer los cambios
        addToSelect(element) //Añadir el dev eliminado a el select de añadir
        delFromList(element) //ELiminar de la lista

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

        //Mensaje de aviso no hay mas desarrolladores
        if ($("#dev-list ul li").length == 0 && $('#dev-list-alert').length == 0) {
            //La lista esta vacía y no hay mensaje mostrandose

            $('#dev-list').before(
                "<div id='dev-list-alert' class='col-12 mt-2' >" +
                "<div class='alert alert-warning alert-dismissible fade show' role='alert'>" +
                "There isn't developers asigned to the project" +
                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                "<span aria-hidden='true'>&times;</span>" +
                "</button>" +
                "</div>" +
                "</div>"
            );

        }

    }
}


/**
 * Eliminar usuario de la tarea, peticion al servidor
 */
function ajaxDelFromList(element) {

    var ruta = element.attr('data-funct'); // Obtener la tuta
    $.ajax({ url: ruta }); // peticion al servidor

}

function delPrepareInterface() {


    //Eliminar el alert
    $("#add-devs-alert").remove()

    //Si el select y el boton no exiten se añaden
    if ($("#add-devs").length == 0) {

        $("#add-devs-container").append(
            "<div id='add-devs' class='col-12'>" +
            "<div class='row'>" +

            //Select developer
            "<div class='col-6'>" +
            "<p>Find developers in this workgroup:</p>" +
            "<select class='browser-default custom-select'></select>" +
            "</div>" +

            //Permissions
            "<div id='permissions' class='col-6 mt-2'>" +
            "<p>Permissions</p>" +
            "<div class='custom-control custom-radio'>" +
            "<input type='radio' class='custom-control-input' id='r1' name='radio' value='1' checked>" +
            "<label class='custom-control-label' for='r1'>Work</label>" +
            "</div>" +
            "<div class='custom-control custom-radio'>" +
            "<input type='radio' class='custom-control-input' id='r2' name='radio' value='0'>" +
            "<label class='custom-control-label' for='r2'>All</label>" +
            "</div>" +
            "</div>" +

            //Button
            "<div class='col-12'><a href class='btn btn-sm btn-primary float-right'>Add selected</a></div>" +

            "</div>" +
            "</div>"
        )


    }

    //ALERT lista vacia
    if ($('#dev-list ul li').length == 0) {

        $('#project-devs-container').append(

            "<div id='dev-list-alert'>" +
            "<div class='alert alert-warning alert-dismissible fade show' role='alert'>" +
            "Currently no developer has been added." +
            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
            "<span aria-hidden='true'>×</span>" +
            "</button>" +
            "</div>" +
            "</div>"

        )
    }





}

/**
 * Añade un desarrollador a el select
 */
function addToSelect(element) {

    //obtener el elemento contenedor
    var itemContainer = element.closest('div').siblings()[0];

    //Extraer los datos
    var itemContent = itemContainer.innerText; //Obtener el contenido del elemento
    var developerId = itemContainer.getAttribute('data-id') //Obtener el id
    var projectId = $('#project-container').attr('data-projectid');
    // var permission = $("#permissions input[checked]").attr("value");


    //Crear el nuevo elemento y añadirlo al select
    var newElement =
        "<option" +
        " data-funct='/project-add-developer-bd/" + projectId + "/" + developerId + "/permissionType'" +
        " value='" + developerId + "'>" + itemContent +
        "</option>";

    $('#add-devs select').append(newElement);

}

/**
 * Elimina un desarrolador de la lista
 * @param element, es el icono del cubo de basura (un <a> donde se produce el click)
 */
function delFromList(element) {
    // Obtener el elemento contenedor y eliminarlo
    element.closest("li").remove();
}

// #endregion

// -----------------------------------------------------------
//                      LISTA AÑADIR
// -----------------------------------------------------------
// #region ListaAñadir

function addDeveloperToList(event) {


    // Anular el efecto de click en el enlace
    event.preventDefault()

    var selectedItem = $('#add-devs select').children(":selected")

    ajaxAddToList(selectedItem)

    //----- Actualizar interface ---------
    //------------------------------------


    addPrepareInterface() // Preparar interface
    addToList(selectedItem)
    delFromSelect(selectedItem)

    //Si el select esta vacío mostrar un alert
    if ($('#add-devs select').has('option').length == 0) {
        selectShowAlert()
    }

}

function selectShowAlert() {

    //Eliminar el selector y el boton
    $("#add-devs").remove();

    //Mostrar mensaje de alerta
    $('#add-devs-container').append(

        "<div id='add-devs-alert' class='col-12'>" +
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
    var permission = $("#permissions input[name='radio']:checked").attr("value");

    // Obtener la ruta de la peticion
    var ruta = element.attr('data-funct');

    ruta = ruta.replace('permissionType', permission);

    // Peticion al server
    $.ajax({ url: ruta });

}

function addPrepareInterface() {


    // Eliminar mensaje de alert
    $("#dev-list-alert").remove()


    var devlist = $("#dev-list");

    //Si la lista no existe se crea
    if (devlist.length == 0) {

        $("#project-devs-container").append(
            "<div id='dev-list'><ul></ul></div>"
        );
    }


}

function addToList(element) {

    // Obtener el contenido y el id
    var itemContent = element.html();
    var devId = element.attr("value");
    var projectId = $('#project-container').attr('data-projectid');

    //Anadir a la lista de desarrolladores
    $('#dev-list ul').append(
        "<li class='list-group-item'>" +
        "<div class='row'>" +
        "<div class='col my-auto' data-id='" + devId + "'>" + itemContent + "</div>" +
        "<div class='col my-auto'>" +
        "<dibv class='float-right'>" +
        "<a data-id='" + devId + "' data-funct='/project-del-developer-bd/" + projectId + "/" + devId + "' href='' class='btn btn-sm text-danger f-remove'>" +
        "<i class='fas fa-trash-alt'></i>" +
        "</a>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</li>"
    );

}

function delFromSelect(element) {
    element.remove();
}

// #endregion




