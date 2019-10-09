$(".button-show-info").on('click', function () {
    $(this).toggleClass('deploy');
    $(this).parent().children('.content').children('.info-text').toggleClass('deploy');
});