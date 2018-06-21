// Plugin options and our code
$(".modal_trigger").leanModal({
    top: 100,
    overlay: 0.6,
    closeButton: ".modal_close"
});

$(function () {
    // Calling Login Form
    $("#login_form").click(function () {
        $(".social_login").hide();
        $(".user_login").show();
        return false;
    });

    // Calling Register Form
    $("#register_form").click(function () {
        $(".social_login").hide();
        $(".user_register").show();
        $(".header_title").text('Register');
        return false;
    });

    // Going back to Social Forms
    $(".back_btn").click(function () {
        $(".user_login").hide();
        $(".user_register").hide();
        $(".social_login").show();
        $(".header_title").text('Login');
        return false;
    });
});
$(".edit_dannie").click(function () {
    $(".first_name_dennie, .last_name_dennie, .address_dennie, .phone_dennie, .save_dennie").attr('disabled', false);
});

$(document).ready(function () {
    cartHeight();
});


function cartHeight() {
    var h = parseInt($(window).height() / 1.8);
    if ($('.cart-content').height() > h) {
        $('.cart-content').css({
            'overflow-y': 'scroll',
            'max-height': parseInt(h) + 'px',
        })


    }
}

$(document).on('click', '.cart-remove', function (event) {
    event.preventDefault();
    parent = $(this).data('status');
    $.ajax({
        url:$(this).attr('href'),
        type:'post',
        data:{order: $(this).data('order'), _token: token},
        success: function (e) {
            if (!e) {
                window.location.href = 'not-found';
            } else {
                $('[data-target="'+parent+'"]').fadeOut(1000, function () {
                    $('.cart-container').html(e);
                    cartHeight();
                });


            }
        },
        error: function () {
            window.location.href = 'not-found';
        }
    })
});

