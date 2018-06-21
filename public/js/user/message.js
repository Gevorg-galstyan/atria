var token = $('meta[name="csrf-token"]').attr('content');

$("#messageSend").submit(function (event) {
    event.preventDefault();
    var text = $(".messageText").val();
    var url = $(this).attr('action');
    if (!text) {
        return false
    } else {
        $(".messageText").val('');
    }
    $.ajax({
        url: url,
        type: 'post',
        data: {text: text, _token: token},
        success: function (e) {
            $('.chat').append(e);
            messageTop();
        }
    })
});


setInterval(function () {
    var message = $('.msg:last').data('message');
    var url = $("#messageSend").attr('action');
    $.ajax({
        url: url,
        type: 'post',
        data: {message: message, key: 'set', _token: token},
        success: function (e) {
            if (e == 0) {
                return false
            } else {
                $('.chat').append(e);
                messageTop();
            }
        }
    });
    setTimeout(function () {
        $(".msg").removeClass('seen');
    },4000);
}, 5000);

$(document).ready(function () {
   messageTop();
});
function messageTop() {
    var b = $('.chat').css('height')
    $('.panel-body').scrollTop(parseInt(b))
}

