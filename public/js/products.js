var token = $('meta[name="csrf-token"]').attr('content');
$(document).on('click', '.products_filter', function () {
    var filter = [];
    $('.products_filter').attr('disabled', true);
    $(".products_filter").each(function (i) {
        if($(this).is(':checked')){
            filter.push($(this).val());
        }
    });
    var url = $('.filter_href').data('href');
    var cat = $('.filter_href').data('cat');
    $.ajax({
        url:url,
        type:'post',
        data:{filter:filter, cat:cat, _token:token},
        success:function (e) {
            $('.single-blog').html(e);
            $('.products_filter').attr('disabled', false);
        }
    });
});


$(document).on('click', '.pagination li a', function (e) {

    e.preventDefault();
    var filter = [];
    $('#loader').fadeIn();
    $(".products_filter").each(function (i) {
        if($(this).is(':checked')){
            filter.push($(this).val());
        }
    });
    var url = $('.filter_href').data('href');
    var cat = $('.filter_href').data('cat');
    var page = $(this).text();

    $.ajax({
        url: url,
        type: 'post',
        data: {page: page, filter:filter, cat:cat, _token:token},

        success: function (e) {
            $('.single-blog').html(e);
            window.scrollTo(0, 0);
            $('#loader').fadeOut();
        }
    });
});