$(function() {




    $('a[data-del]').click(function(event){

        event.preventDefault()
        if(confirm("Are you sure to delete task group?")){

            $.get($(this).attr('data-ajax'))

        }


    })





})
