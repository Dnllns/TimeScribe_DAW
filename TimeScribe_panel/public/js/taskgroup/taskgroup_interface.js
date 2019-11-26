$(function() {


    $("a.f-remove").click(function() {

        //Peticion al servidor
        //-------------------
        $.get($(this).attr("data-funct"))

        //Eliminar de la interface
        //-------------------

        //Borrar de la lista
        $(this).closest("li").remove()

    })


});