$(window).on('load', function() {

    $(".dragg-container").sortable({
        connectWith: ".dragg-container",
        handle: ".item-move",
        start: function(event, ui) {
            ui.item.addClass('tilt');
            tilt_direction(ui.item);
        },
        stop: function(event, ui) {
            ui.item.removeClass("tilt");
            $("html").unbind('mousemove', ui.item.data("move_handler"));
            ui.item.removeData("move_handler");
        }
    });

    function tilt_direction(item) {
        var left_pos = item.position().left,
            move_handler = function(e) {
                if (e.pageX >= left_pos) {
                    item.addClass("right");
                    item.removeClass("left");
                } else {
                    item.addClass("left");
                    item.removeClass("right");
                }
                left_pos = e.pageX;
            };
        $("html").bind("mousemove", move_handler);
        item.data("move_handler", move_handler);
    }


});