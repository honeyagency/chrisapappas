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
jQuery(document).ready(function(e) {
    $sb = $('#searchform > div > input#s');
    $sb.attr('placeholder', 'SEARCH');
    $sb.on('focus', function(event) {
        $(this).attr('placeholder', '');
    });
    $('.menu--trigger').on('click touchstart', function(e) {
        event.preventDefault();
        $('body').toggleClass('openmobile');
        $('header').toggleClass('openmobile');
    });
    $('.icon-social--search').on('click', function(e) {
        if ($(this).hasClass('fixed')) {
            console.log('fixed');
            $socialWrap = $('.section--social.notfixed');
        } else {
            $socialWrap = $(this).parent('.section--social');
        }
        $search = $socialWrap.children('form').children('div').children('#s');
        if ($socialWrap.hasClass('searching')) {
            $search.blur();
        } else {
            $search.focus();
        }
        $socialWrap.toggleClass('searching');
    });
    $('.mc-layout__modalContent > iframe > body').css('font-family', 'sofia-pro,sans-serif');
});
$('.section--content p').each(function() {
    var $p = $(this),
        txt = $p.html();
    if (txt == '&nbsp;') {
        $p.remove();
    }
});
$('.section--content p span').each(function() {
    $(this).removeAttr('style');
});