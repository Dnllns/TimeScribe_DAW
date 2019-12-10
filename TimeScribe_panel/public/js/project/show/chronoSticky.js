jQuery(function($) {
    function fixDiv() {
        var $cache = $('#sticky-chrono');
        if ($(window).scrollTop() > 40)
            $cache.css({
                'position': 'fixed',
                'bottom': '10px',
                'z-index':'1'
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
