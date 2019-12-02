jQuery(function($) {
    function fixDiv() {
        var $cache = $('#sticky-chrono');
        if ($(window).scrollTop() > 40)
            $cache.css({
                'position': 'fixed',
                'top': '10px'
            });
        else
            $cache.css({
                'position': 'relative',
                'top': 'auto'
            });
    }
    $(window).scroll(fixDiv);
    fixDiv();
});
