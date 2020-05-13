$(document).ready(function () {

    $('.sub').hide();
    $(".sub").css({
    });
    $(".sub li").css({
        'background': '#f7f6f6',
    });

    $('.opensub').click(function () {
        $('.sub').slideUp(200);
        $(this).parent().next().toggle(100);
    })
});

$('body').click(function(e) {
    if ($(e.target).closest('.opensub').length === 0) {
        $('.sub').hide();
    }
});

function previewImage() {
    document.getElementById("foto").onchange = function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById("photo").src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    };
}

