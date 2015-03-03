$(document).ready(function() {

    /* Play and Pause */
    /**
     * Store the transition end event names for convenience.
     */
    var transitionEnd = 'transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd';

    /**
     * Trigger the play button states upon clicking.
     */
    $('.play-btn').click(function(e) {

        e.preventDefault();

        if ($('.play-btn').hasClass('pause')) {
            $('.play-btn').removeClass('pause')
                .addClass('to-play');
        } else if (!$(this).hasClass('to-play')) {
            $('.play-btn').addClass('pause');
        }
        
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "/api/pause.php", true);
                xmlhttp.send();

    });

    /**
     * Remove the 'to-play' class upon transition end.
     */
    $(document).on(transitionEnd, '.to-play', function() {
        $(this).removeClass('to-play');
    });

    /* Nav Arrow */
    /**
     * Trigger the arrow button states upon clicking.
     */
    $('.arrow-btn').click(function(e) {
        if ($('.arrow-btn').hasClass('up')) {
            $.fn.fullpage.moveSectionUp();
            $('.arrow-btn').removeClass('up')
                .addClass('to-down');
        } else if (!$(this).hasClass('to-down')) {
            $.fn.fullpage.moveSectionDown();
            $('.arrow-btn').addClass('up');
        }
    });

    /**
     * Remove the 'to-up' class upon transition end.
     */
    $(document).on(transitionEnd, '.to-down', function() {
        $(this).removeClass('to-down');
    });

    $('#fullpage').fullpage({
        onLeave: function(index, nextIndex, direction) {
            var leavingSection = $(this);

            if (index == 1) {
                $('.arrow-btn').addClass('up');
            } else if (index == 2) {
                $('.arrow-btn').removeClass('up')
                    .addClass('to-down');
            }
        }
    });
});