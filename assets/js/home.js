var flashMessages = $('.flash-messages');

$(function () {
    $('.flash-message').toggleClass('show');
    if (flashMessages.find('.show').length > 0) {
        flashMessages.addClass('visible');
    }
});

$('.btn-close-flash').on('click', function () {
    $(this).parent().parent().toggleClass('show');
    if (flashMessages.find('.show').length === 0) {
        flashMessages.removeClass('visible');
    }
});

var nav = document.getElementById("nav-stick");

window.onscroll = function () {
    if(window.scrollY > 100) {
        nav.classList.add('show');
    } else {
        nav.classList.remove('show');
    }
};