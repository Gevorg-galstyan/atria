var filter = [];
var filter_name = [];
var quantity = $('#quantity').val();
var color = false;
var a = [];
var fl = [];


$(".comment_form").validate({
    rules: {
        comment: {
            required: true
        }
    },
    submitHandler: function (form) {
        $.ajax({
            url: $(".comment_form").attr('action'),
            type: $(".comment_form").attr('method'),
            data: $(".comment_form").serialize(),
            success: function (data) {
                if (data['success']) {
                    $('.comment_form').css('display', 'none').find('[name="comment"]').val('');
                    $('.contact_form_container').append('' +
                        '<div class="row comment_success">' +
                        '<div class="col-sm-12 text-center">' +
                        data['success'] +
                        '</div>' +
                        '</div>' +
                        '');

                } else {
                    window.location.href = 'not-found';
                }
            },
            error: function (data) {
                window.location.href = 'not-found';
            }
        });
    }
});
$(document).on('click', '.again_comment', function () {
    $('.comment_success').remove();
    $('.comment_form').fadeIn();
});

(function ($) {
    "use strict";
    $('a[data-gal]').each(function () {
        $(this).attr('rel', $(this).data('gal'));
    });
    $("a[data-rel^='prettyPhoto']").prettyPhoto({
        animationSpeed: 'slow',
        theme: 'light_square',
        slideshow: true,
        overlay_gallery: true,
        social_tools: false,
        deeplinking: false
    });
})($);


$('.product_filter').change(function () {
    var value = $(this).val();
    url = $(this).data('href');
    prod = $(this).data('prod');
    filter_name.push($(this).data('filter'));
    fl = [];
    a = [];
    filter = [];
    if (value) {
        $('.product_filter').each(function (i) {
            if ($(this).val()) {
                filter.push($(this).val());
                a.push($('option[value="' + $(this).val() + '"]').data('name'));
                fl.push($('option[value="' + $(this).val() + '"]').data('fl'));
            }
        });
        $.ajax({
            url: url,
            type: 'post',
            data: {filter: filter, prod: prod, _token: token},
            success: function (e) {
                if (e['price']) {
                    $('.prod_price').text(e['price']);
                }
            }
        })
    }
});


$('.prod_color').click(function () {
    $('.prod_color_active').removeClass('prod_color_active').addClass('prod_color');
    $(this).removeClass('prod_color').addClass('prod_color_active');
    color = $(this).data('value');
});


$('.quantity-right-plus').click(function (e) {

    // Stop acting like a button
    e.preventDefault();
    // Get the field name
    quantity = parseInt($('#quantity').val());

    // If is not undefined

    $('#quantity').val(quantity + 1);
    quantity = $('#quantity').val();

    // Increment

});

$('.quantity-left-minus').click(function (e) {
    // Stop acting like a button
    e.preventDefault();
    // Get the field name
    var quantity = parseInt($('#quantity').val());

    // If is not undefined

    // Increment
    if (quantity > 1) {
        $('#quantity').val(quantity - 1);
        quantity = $('#quantity').val();
    }
});


$(document).on('click', function () {
    if ($('#quantity').val() < 1) {
        $('#quantity').val(1)
    }
    if (quantity && color && product) {
        var flag = $('select.product_filter');
        if (filter.length == flag.length
            && a.length == flag.length
            && fl.length == flag.length
            && filter_name.length == flag.length) {

            $('.add_cart').attr('disabled', false)
        }

    }
});


$(document).on('click', '.add_cart', function (event) {
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        type: 'post',
        data: {
            filter: filter,
            color: color,
            prod: product,
            qty: quantity,
            name: a,
            fl: fl,
            filter_name: filter_name,
            _token: token
        },
        success: function (e) {
            if (!e) {
                window.location.href = 'not-found';
            } else {
                $('.cart-container').html(e);
                cartHeight();
            }
        },
        error: function () {
            window.location.href = 'not-found';
        }
    });
});




