var token = $('meta[name="csrf-token"]').attr('content');

$(document).on('click', '.pagination li a', function (e) {

    e.preventDefault();
    $('#loader').fadeIn();
    var page = $(this).text();
    // alert()

    var word = $('#searchArea').val();
    var url = $(this).data('result_page');

    $.ajax({
        url: url,
        type: 'post',
        data: {word: word, page: page, key: "ajax", _token: token},

        success: function (e) {
            $('.single-blog').html(e);
            window.scrollTo(0, 0);
            $('#loader').fadeOut();
        }
    });
});




