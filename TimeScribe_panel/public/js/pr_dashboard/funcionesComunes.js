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