$(function() {
    
});

function addToCart(product) {
    $.ajax({
        type:'GET',
        url:'/cart/add/' + product,
        beforeSend: function() {
            $('#success').html('<i class="fa fa-spinner fa-spin"></i> <br> Aguarde por favor...')
            .addClass('fixedMessage');
        },
        success:function(data) {
            // alert(data);
            data = $.parseJSON( data );
            $(".total-cart").text(data.total);
            $('#success').html(data.message);
            setTimeout(function() {
                $('#success').html('').removeClass('fixedMessage');
           }, 4000);
        }
    })
    
}

function openSearch() {
    var form = $("#form").html();

    $("#search").html(form).addClass('search');
}

function closeSearch() {
    $("#search").html('').removeClass('search');
}