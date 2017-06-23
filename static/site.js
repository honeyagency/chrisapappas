function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this,
            args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

function stickyNav(e) {
    var $header = $('header.fixed-nav');
    var $fixSpot = $header.next().offset().top + 10;
    var $fixSpotClose = $fixSpot + 40;
    var $theWin = $(document).scrollTop();
    var $theBod = $('body');
    if ($fixSpot <= $theWin) {
        $header.addClass('fixed');
        $theBod.addClass('fixed');
    } else {
        if ($header.hasClass('fixed')) {
            $header.addClass('hasbeenopened');
        }
        $header.removeClass('fixed');
        $theBod.removeClass('fixed');
    }
}
var stickyNavDebounce = debounce(function(e) {
    stickyNav(e);
}, 10);
window.addEventListener('scroll', stickyNavDebounce);


jQuery(document).ready(function($) {
    $('.menu--trigger').on('click touchstart', function(event) {
        event.preventDefault();
        $('body').toggleClass('openmobile');
        $('nav').toggleClass('openmobile');
    });
});