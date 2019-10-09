var leftAside = document.getElementById("left-aside");
var rightAside = document.getElementById("right-aside");
var btnDeploy = document.getElementById("button-deploy");

btnDeploy.onclick = function () {
    if (leftAside.classList.contains('left-aside-open')) {
        leftAside.classList.remove('left-aside-open');
    } else {
        leftAside.classList.add('left-aside-open');
    }

    if (rightAside.classList.contains('left-aside-open')) {
        rightAside.classList.remove('left-aside-open');
    } else {
        rightAside.classList.add('left-aside-open');
    }
};

$('.btn-toggle').on('click', function () {
    let buttonClicked = $(this);
    buttonClicked.attr("disabled", "disabled");
    buttonClicked.toggleClass('on-changement');
    let dataUrl = buttonClicked.attr('data-url');
    setTimeout(
    function()
    {
        $.ajax({
            url: dataUrl,
            context: document.body
        }).done(function () {
            buttonClicked.toggleClass('on-changement');
            buttonClicked.toggleClass('active');
            buttonClicked.removeAttr("disabled", "disabled");
        });
    }, 500);
});

$('.toggle-boolean').on('click', function () {
    $(this).toggleClass('checked');
});