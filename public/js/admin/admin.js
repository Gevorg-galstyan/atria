/**
 * Created by Tatev on 6/13/2017.
 */
var token = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {


    $('#table').DataTable();

    $('.blockUser').change(function () {
        var public = false;
        var url = $(this).data('href');
        var user = $(this).data('user');

        if ($(this).is(':checked')) {
            public = 1;
        } else {
            public = 0;
        }
        $.ajax({
            url: url,
            type: 'post',
            data: {user: user, public: public, _token: token},

        })
    })
});

//=============================  UPDATE ========================//

$(document).on('click', '.iconUpdate', function () {
    $('.updateForm').html('');
    parent = $(this).data('status');
    url = $('[data-target="' + parent + '"]').data('href_update');
    prod = $('[data-target="' + parent + '"]').data('prod');
    data = {prod: prod, key: 'one', _token: token};
    $.ajax({
        url: url,
        type: 'post',
        data: data,
        success: function (data) {
            if (data != 0) {
                $('.updateForm').html(data);
                $('.sort, #sortable').sortable();
            }
            else {
                $(".msj-success").html(data);
                $(".msj-success").fadeIn();
                setTimeout(function () {
                    $(".msj-success").fadeOut();
                    $(".msj-success").html('<ul></ul>');
                }, 5000);
            }
        },
        error: function (e) {
            // ajaxError(e);
        }
    });
});


//=============================  DELETE ========================//

$(document).on('click', '.iconDelete', function () {
    parent = $(this).data('status');
    url = $('[data-target="' + parent + '"]').data('href_delete');
    prod = $('[data-target="' + parent + '"]').data('prod');
    key = $('[data-target="' + parent + '"]').data('key');
    data = {prod: prod, key: key, _token: token};
});

$(document).on('click', '.modalDelete', function () {
    $.ajax({
        url: url,
        type: 'post',
        data: data,
        success: function (data) {
            if (data == 1) {
                $('[data-target="' + parent + '"]').fadeOut(500, function () {
                    $(this).remove();
                })
            } else {
                $(".msj-success").html(data);
                $(".msj-success").fadeIn();
                setTimeout(function () {
                    $(".msj-success").fadeOut();
                    $(".msj-success").html('<ul></ul>');
                }, 5000);
            }
        }
    })
});

$(document).ajaxStart(function () {
    $(".loaderSite").show();
});

$(document).ajaxStop(function () {
    $(".loaderSite").hide();
});

$(document).on('click', '.spanClose', function () {
    $('.info_modal').fadeOut().find('image_section').html('');
});

$(document).on('click', '.btn_delete', function () {
    $('.myModal').css('display', 'block');
});

$(document).on('click', '.myModal', function (event) {

    if (event == $('.myModal-content')) {
        $('.myModal').css('display', 'none');
    }
});
$(document).on('click', '.btn_my_modal', function () {


    $('.myModal').css('display', 'none');

});
//  ==================== INPUT FILE =======================//

$(function () {

    $(document).on('click', '.image', function (e) {
        $('[data-xname="' + $(this).data('name') + '"]').html('');

    });

    basic = [];
    $(document).on('change', '.image', function (e) {
        basic = [];
        this_file = $(this).data('name');
        var files = e.target.files;
        for (i = 0; i <= files.length; i++) {
            // when i == files.length reorder and break
            if (i == files.length) {

                // need timeout to reorder beacuse prepend is not done
                setTimeout(function () {
                    reorderImages();
                }, 100);
                break;
            }

            var file = files[i];
            var reader = new FileReader();
            // $('.sort').html('');
            reader.onload = (function (file) {

                return function (event) {
                    $('[data-xname="' + this_file + '"]').prepend('' +
                        '<div class="col-sm-4">' +
                        '<div class=" demo"   data-id="' + file.lastModified + '">' +
                        // '<div class="demo col-sm-3">' +
                        // '<img class="my-image" src="' + event.target.result + '" style="width:100%;" /> ' +
                        // '</div>' +
                        '</div>' +
                        '</div>' +
                        '');
                    $('.demo').each(function (i) {
                        if ($(this).data('crop') != 1) {

                            basic.push($(this).croppie({

                                url: event.target.result,
                                viewport: {
                                    width: 250,
                                    height: 162.5
                                },
                                boundary: {
                                    width: 300,
                                    height: 200
                                }
                            }));
                        }
                        $(this).data('crop', 1);

                    });
                    $(".cr-slider").remove();
                };
            })(file);
            reader.readAsDataURL(file);
        }// end for;
    });


    $('.sort, #sortable').disableSelection();
    $('.sort, #sortable').on('sortbeforestop', function (event) {
        reorderImages();
    });
    function reorderImages() {
        var images = $('.sort');
        var i = 0, nrOrder = 0;
        for (i; i < images.length; i++) {
            var image = $(images[i]);
            if (image.hasClass('ui-state-default') && !image.hasClass('ui-sortable-placeholder')) {
                image.attr('data-order', nrOrder);
                var orderNumberBox = image.find('.order-number');
                orderNumberBox.html(nrOrder + 1);
                nrOrder++;
            }// end if;
        }// end for;
    }
});
$(".productMulty").validate({
    rules: {
        img: {
            required: true,
            accept: "jpeg,JPEG,png,PNG,jpg,JPG,gif,svg"
        }
    },

});

$(document).on('validate', '.productMulty', {
    rules: {
        "image.*": {
            accept: "jpeg,JPEG,png,PNG,jpg,JPG,gif,svg"
        }

    },
    // range:
    submitHandler: function (form) {
        console.log(basic)

    }
});

$(document).on('submit', '.productMulty', function (form) {
    f = $(this);
    $(basic).each(function (index) {
        basic[index].croppie('result', {
            type: 'canvas',
            size: {
                width: prodImageW,
                height: prodImageH
            },
        }).then(function (resp) {
            f.find('.imageContainer').append('' +
                '<input type="hidden" name="image[]" value="' + resp + '"/>' +
                '');
        });
    });

});

$(document).on('click', '.js-labelFile', function () {
    $('.input-file').each(function () {
        var $input = $(this),
            $label = $input.next('.js-labelFile'),
            labelVal = $label.html();

        $input.on('change', function (element) {
            var fileName = '';
            if (element.target.value) fileName = element.target.value.split('\\').pop();
            fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
        });
    });
});

// })();
$(document).on('click', ".span_reset_file", function () {
    $(".cr-image").fadeOut();
    $('.upload2').val('');
    $('.js-labelFile').removeClass('has-file').find('.js-fileName').text('Change a Image');
    $(this).fadeOut();
});

//=============================  IMAGE CROP ========================//

// $(document).on('click', '.basic-result', function () {
//     var w = parseInt($w.val(), 10),
//         h = parseInt($h.val(), 10), s
//     size = 'viewport';
//     if (w || h) {
//         size = {width: w, height: h};
//     }
//     $uploadCrop.croppie('result', {
//         type: 'canvas',
//         size: size
//     }).then(function (resp) {
//         popupResult({
//             src: resp
//         });
//     });
// });
//
// function popupResult(result) {
//     var html;
//     if (result.html) {
//         html = result.html;
//     }
//     if (result.src) {
//         html = '<img src="' + result.src + '" />';
//         $(".info_modal").fadeIn();
//         $('.image_section').html(html);
//
//     }
//
// }


$(document).on("change", '.upload2', function () {

    $(".cr-image").fadeIn();
    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop1.croppie("bind", {
            url: e.target.result,
        }).then(function () {
            $w1 = $('.basic-width'),
                $h1 = $('.basic-height'),

                $uploadCrop1.croppie('bind', {
                    url: e.target.result,

                });
        });
    };
    reader.readAsDataURL(this.files[0]);
});
$(document).on("change", '.upload3', function () {
    $(".cr-image").fadeIn();
    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop.croppie("bind", {
            url: e.target.result,
        }).then(function () {
            $w = $('.basic-'),
                $h = $('.basic-height'),

                $uploadCrop.croppie('bind', {
                    url: e.target.result,

                });
        });
    };
    reader.readAsDataURL(this.files[0]);
});


$(document).on('submit', ".formImage", function (form) {
    form = form;
    f = $(this);
    $uploadCrop1.croppie('result', {
        type: 'canvas',
        size: {
            width: w1,
            height: h1
        },
    }).then(function (resp) {
        if ($(f).find('input[type="file"]').val()) {
            $(f).find('input[name="image"]').val(resp);
        }
    });
    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: {
            width: w,
            height: h
        },
    }).then(function (resp) {
        if ($(f).find('input[type="file"]').val()) {
            $(f).find('input[name="imageGeneral"]').val(resp);
        }
    });
});


// $(document).on('submit', "#addSubCategory", function (form) {
//     $uploadCrop.croppie('result', {
//         type: 'canvas',
//         size: 'viewport'
//     }).then(function (resp) {
//         if ($('input[type="file"]').val()) {
//             $('input[name="image"]').val(resp);
//         }
//     });
// });


//=================================  COLOR  ===========================//
var color = 2;
$(document).on('click', ".add_color", function () {
    var data = $(this).data('color');
    $('div[data-color_container="' + data + '"]').append('' +
        '<div class="col-sm-1"  data-status="color_' + color + '">' +
        '<span class=" delete_color cursor_pointer" data-target="color_' + color + '">' +
        '<i class="fa fa-times" aria-hidden="true"></i>' +
        '</span>' +
        '<input type="color" name="color[]" >' +
        '</div>' +
        '');
    color++;
});

$(document).on('click', '.delete_color', function () {
    var data = $(this).data('target');
    $('[data-status="' + data + '"]').fadeOut().remove();
});

// ================================ FILTER CHECKBOX =======================//

$(document).on('change', '.filter_checkbox', function () {
    var data = $(this).data('target');
    if ($(this).is(':checked')) {
        $('[data-status="' + data + '"]').attr({
            'disabled': false
        }).focus();
        $('[data-status_sale="' + data + '"]').attr({
            'disabled': false
        });

    } else {
        var flag = false;
        $('.filter_checkbox').each(function () {
            if ($(this).is(':checked')) {
                flag = true;
            }
        });
        if (flag) {
            $('[name="firstPrice"]').prop({
                'required': false
            });
        } else {
            $('[name="firstPrice"]').prop({
                'required': true
            });
        }
        $('[data-status="' + data + '"]')
            .val('').attr({
            'required': false,
            'disabled': true
        });
        $('[data-status_sale="' + data + '"]').attr({
            'disabled': true
        });

    }
});
$(document).on('keyup', '.filter_price', function () {
    if ($(this).val()) {
        $('.firstPrice').prop('required', false);
    }
});

$(document).on('click', '.delete_update_image', function () {
    $('.modal_delete_image').remove();
    $(this).parent().append(
        '<div class="modal_delete_image">' +
        '<div class="box box-danger">' +
        '<div class="box-body">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        '<p>Do you really want to delete</p>' +
        '</div>' +
        '<div class="btn-group">' +
        '<button type="button" class="btn btn-danger modalDelete dellImage">delete</button>' +
        '<button type="button" class="btn btn-default closeDell">Close</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>'
    )
});

$(document).on('click', '.closeDell', function (e) {
    $('.modal_delete_image').remove();
});

$(document).on('click', '.dellImage', function (e) {
    e.stopPropagation();
});


// =================================== FILTER =========================================//

var filter = 0;

$(document).on('click', '.add_filter', function () {
    $('.filter_container').prepend('' +
        '<div class="panel panel-danger" data-filter="' + filter + '">' +
        '<div class=" panel-heading text-center">' +
        'Filter ' + parseInt(filter + 1) +
        '<button data-target_parent_filter="' + filter + '" type="button" class="btn btn-danger delete_parent_filter pull-right" title="Delete">' +
        '<i class="fa fa-times" aria-hidden="true"></i>' +
        '</button>' +
        '</div>' +
        '<div class="panel-body">' +
        '<div class="row">' +
        '<div class="col-xs-4">' +
        '<div class="form-group text-center">' +
        '<label>Հայերեն</label>' +
        '<input type="text" name="hy_name_filter[' + filter + ']" class="form-control"' +
        'placeholder="Հայերեն" required>' +
        '</div>' +
        '</div>' +
        '<div class="col-xs-4">' +
        '<div class="form-group text-center">' +
        '<label>English</label>' +
        '<input type="text" name="en_name_filter[' + filter + ']" class="form-control"' +
        'placeholder="English" required>' +
        '</div>' +
        '</div>' +
        '<div class="col-xs-4">' +
        '<div class="form-group text-center">' +
        '<label>Русский</label>' +
        '<input type="text" name="ru_name_filter[' + filter + ']" class="form-control"' +
        ' placeholder="Русский" required>' +
        ' </div>' +
        '</div>' +
        '</div>' +
        '<div class="row">' +
        '<h3 class="text-center">' +
        'Add Sub Filter' +
        '<button type="button" class="btn btn-info add_sub_filter" data-sub_filter="' + filter + '"' +
        'title="Add Sub Filter">' +
        '<i class="fa fa-plus"></i>' +
        '</button>' +
        '</h3>' +
        '</div>' +
        '<div class="sub_filter_content">' +
        '</div>' +
        '</div>' +
        '</div>');

    filter++;


});
var number = 0;

$(document).on('click', '.add_sub_filter', function () {
    sub_filter = $(this).data('sub_filter');
    var parent = $('[data-filter="' + sub_filter + '"]');


    parent.find('.sub_filter_content').append('' +
        '<div  data-name="new_' + number + '" data-status="delete' + number + '" >' +
        '<div class="row" >' +
        '<div class="col-xs-3">' +
        '<div class="form-group text-center">' +
        '<label>Հայերեն</label>' +
        '<input type="text" name="hy_name_sub[' + sub_filter + '][]" class="form-control" placeholder="Հայերեն" required>' +
        '</div>' +
        '</div>' +
        '<div class="col-xs-3">' +
        '<div class="form-group text-center">' +
        '<label>English</label>' +
        '<input type="text" name="en_name_sub[' + sub_filter + '][]" class="form-control" placeholder="English" required>' +
        '</div>' +
        '</div>' +
        '<div class="col-xs-3">' +
        '<div class="form-group text-center">' +
        '<label>Русский</label>' +
        '<input type="text" name="ru_name_sub[' + sub_filter + '][]" class="form-control" placeholder="Русский" required>' +
        '</div>' +
        '</div>' +
        '<button data-prefix="new_" data-target="' + number + '" data-val="' + sub_filter + '" type="button" class="btn btn-info add_filter_value" title="Add Child">' +
        '<i class="fa fa-plus"></i>' +
        '</button>' +
        '<button data-target="delete' + number + '" type="button" class="btn btn-danger delete_filter" title="Delete">' +
        '<i class="fa fa-times" aria-hidden="true"></i>' +
        '</button>' +
        '</div>' +
        '</div>' +
        '');
    number++
});

var dell = 0;
$(document).on('click', '.add_filter_value', function () {
    var data = $(this).data('target');
    var prefix = $(this).data('prefix');
    var val = $(this).data('val');


    $('[data-name="' + prefix + data + '"]').append('' +
        '<div class="row" data-status="delete' + data + '" data-dell="delete' + data + dell + '">' +
        '<div class="col-xs-1">' +
        '</div>' +
        '<div class="col-xs-3">' +
        '<div class="form-group text-center">' +
        '<label>Հայերեն</label>' +
        '<input type="text" name="hy_sub[' + val + '][' + data + '][]" class="form-control" placeholder="Հայերեն" required>' +
        '</div>' +
        '</div>' +
        '<div class="col-xs-3">' +
        '<div class="form-group text-center">' +
        '<label>English</label>' +
        '<input type="text" name="en_sub[' + val + '][' + data + '][]" class="form-control" placeholder="English" required>' +
        '</div>' +
        '</div>' +
        '<div class="col-xs-3">' +
        '<div class="form-group text-center">' +
        '<label>Русский</label>' +
        '<input type="text" name="ru_sub[' + val + '][' + data + '][]" class="form-control" placeholder="Русский" required>' +
        '</div>' +
        '</div>' +
        '<div class="col-xs-2">' +
        '<button data-target="delete' + parseInt(number - 1) + '" type="button" class="btn btn-danger delete_filter_find" data-dell_button="delete' + data + dell + '" title="Delete">' +
        '<i class="fa fa-times" aria-hidden="true"></i>' +
        '</button>' +
        '</div>' +

        '</div>' +
        '');
    dell++;
});

$(document).on('click', '.delete_filter', function () {
    var data = $(this).data('target');
    $('[data-status="' + data + '"]').fadeOut().remove();
});


$(document).on('click', '.delete_filter_find', function () {
    var data = $(this).data('dell_button');
    $('[data-dell="' + data + '"]').fadeOut().remove();
});

$(document).on('click', '.delete_parent_filter', function () {
    var deleteFilter = $(this).data('target_parent_filter');
    $('[data-filter="' + deleteFilter + '"]').fadeOut().remove();
});


/* *********** SUBSCRIBE **************** */
$('#selectAll').click(function (e) {
    var table = $(e.target).closest('table');
    $('td input:checkbox', table).prop('checked', this.checked);
});

$("#btn_").on('click', function () {
    emails = [];

    $(".checkbox").each(function () {
        if ($(this).is(':checked')) {
            emails.push($(this).data('email'));
        }
    });


});

$(document).on('submit', '.form_subscribers', function (e) {
    e.preventDefault();
    var name = $('.form_subscribers').find('[name="name"]').val();
    var description = $('.form_subscribers').find('[name="description"]').val();
    $.ajax({
        url: $('.form_subscribers').attr('action'),
        type: 'post',
        data: {emails: emails, name: name, description: description, _token: token},
        success: function (e) {
            var klass_alert = 'success';
            var alert_content = false;
            if (e['success']) {
                klass_alert = 'success';
                var alert_content = e['success'];
            } else {
                klass_alert = 'danger';
                var alert_content = e[0];
            }
            $('#sendSubscribers').modal('hide');
            $(".content").prepend('' +
                '<div class="alert alert-' + klass_alert + ' alert-dismissable fade in">' +
                '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                '<strong>' + alert_content + '</strong>' +
                '</div>');


        }
    })
});


/* *********** COMMENTS **************** */
$(document).on('click', '.unpublish_comment', function () {
    btn = $(this);
    btn.attr('disabled', true);
    parent = $(this).data('status');
    public = false;
    if ($(this).val() == 1) {
        public = 0
    } else {
        public = 1
    }

    url = $('[data-target="' + parent + '"]').data('href_edit');
    prod = $('[data-target="' + parent + '"]').data('prod');
    data = {prod: prod, public: public, _token: token};

    $.ajax({
        url: url,
        type: 'get',
        data: data,
        success: function (e) {
            if (e == 1) {
                if (public == 1) {
                    btn.text('Unpublish');
                    btn.val(1)
                } else {
                    btn.text('Publish');
                    btn.val(0)
                }
                btn.attr('disabled', false);
            }

        }
    });
});