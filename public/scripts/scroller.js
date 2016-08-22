/**
 * jQuery function that allows the profile side bar to stay fixed to the side
 * of the page until the website footer reaches it, on which it becomes
 * absolutely postioned.
 *
 * @author Graham von Oehsen <graham@roundsphere.com>
 */
$(document).ready(function() {
    var width = $('#prof-bar').outerWidth();

    var $root = $('html, body');
    $('.click-top').on('click', function(ev) {
        $root.stop(true, false).animate({ scrollTop: 0 }, 500);
    });

    $(window).scroll(function() {
        var length = $('#prof-content').height();
        var height = $('#prof-bar').height();
        var dif = length - height;
        var scroll = $(this).scrollTop();

        if (scroll > dif && dif > 0) {
            $('#prof-bar').css({
                'position': 'absolute',
                'bottom': '0',
            });
        } else if (dif <= 0) {
            $('#prof-bar').css({
                'position': 'absolute',
                'bottom': 'auto',
                'width': width,
            });
        } else {
            $('#prof-bar').css({
                'position': 'fixed',
                'height': height,
                'bottom': 'auto',
                'width': width,
            });
        }
    });
});
