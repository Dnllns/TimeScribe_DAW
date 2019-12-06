$(function() {

    window.onresize = checkCollapse;

});



function checkCollapse(){

    var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    $collapsables = $('div[data-collapse="js"]')


    //Tamaño de la pantalla mayor a 992px col-md
    if( w >= 992){
        $collapsables.removeClass("collapse")
    }
    else{
        $collapsables.each( function() {
            if(!$(this).hasClass("collapse")){
                $(this).addClass('collapse')
            }
        })
    }


}

