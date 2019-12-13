/**
 * ----------------------------------------------------------------------
 * ----------------------FUNCIONES COMUNES-------------------------------
 * ----------------------------------------------------------------------
 */


/**
 * Obtiene el id del elemento pasado por pararm
 * Se espera que tenga la forma 'elem_id'
 */
function getId(element) {

    var fullId = element.attr('id')
    var task_id = fullId.substr(
        fullId.lastIndexOf("_") + 1,
        fullId.length
    )
    return task_id
}




//-----------------------------------------------------
// HTML
//---------------------------------------------------




function getAlert(id, style, data){

    return "<div id='"+ id + "'>" +
    "<div class='alert alert-" + style + " alert-dismissible fade show' role='alert'> " +
    data +
    " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
    "<span aria-hidden='true'>×</span>" +
    "</button>" +
    "</div>" +
    "</div>"

}


// function getLi(){
//     "<li class='list-group-item'>" +
//     "<div class='row'>" +
//     "<div class='col-10'>" + nombre + ", " + email + "</div>" +
//     "<div class='col'>" +
//     "<div class='float-right'>" +
//     "<a href='' class='btn btn-circle btn-sm bg-dark text-white f-remove'>" +
//     "<i class='fas fa-trash-alt'></i>" +
//     "</a>" +
//     "</div>" +
//     "</div>" +
//     "</div>" +
//     "</li>"
// }
