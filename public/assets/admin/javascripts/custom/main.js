const SITE_URL_SUPER_ADMIN = 'http://lara-ecom.sonjoy/super-admin/';
const SITE_URL_ADMIN = 'http://lara-ecom.sonjoy/admin/';

// Page Testing Purpose...
// alert();

// UPDATE BRAND STATUS using js
$('body').on('change', '#brandStatus', function () {
    var id = $(this).attr('data-id');

    if(this.checked) {
        var status = 1;
    } else {
        var status = 0;
    }
    // alert(id + status);

    $('.loader-overlay').show();
    $.ajax({
        url: "brands/status/" + id + '/' + status,
        method: 'get',
        success: function (result) {
            // console.log(result);
            $('.loader-overlay').hide();
        }

    });

});


// UPDATE CATEGORY STATUS using js
$('body').on('change', '#categoryStatus', function () {
    var id = $(this).attr('data-id');

    if (this.checked) {
        var status = 1;
    } else {
        var status = 0;
    }
    // alert(id + status);

    $('.loader-overlay').show();
    $.ajax({
        url: "categories/status/" + id + '/' + status,
        method: 'get',
        success: function (result) {
            // console.log(result);
            $('.loader-overlay').hide();
        }

    });

});


// UPDATE SUB-CATEGORY STATUS using js
$('body').on('change', '#subCategoryStatus', function () {
    var id = $(this).attr('data-id');

    if (this.checked) {
        var status = 'active';
    } else {
        var status = 'inactive';
    }
    // alert(id + status);

    $('.loader-overlay').show();
    $.ajax({
        url: "sub-categories/status/" + id + '/' + status,
        method: 'get',
        success: function (result) {
            // console.log(result);
            $('.loader-overlay').hide();
        }

    });

});


// UPDATE SLIDER STATUS using js
$('body').on('change', '#sliderStatus', function () {
    var id = $(this).attr('data-id');

    if (this.checked) {
        var status = 'active';
    } else {
        var status = 'inactive';
    }
    // alert(id + status);

    $('.loader-overlay').show();
    $.ajax({
        url: "sliders/status/" + id + '/' + status,
        method: 'get',
        success: function (result) {
            // console.log(result);
            $('.loader-overlay').hide();
        }

    });

});

// UPDATE SLIDER STATUS using js
$('body').on('change', '#productStatus', function () {
    var id = $(this).attr('data-id');

    if (this.checked) {
        var status = 'active';
    } else {
        var status = 'inactive';
    }
    // alert(id + status);

    $('.loader-overlay').show();
    $.ajax({
        url: "products/status/" + id + '/' + status,
        method: 'get',
        success: function (result) {
            // console.log(result);
            $('.loader-overlay').hide();
        }

    });

});

// UPDATE ORDER STATUS using js...
$('body').on('change', '#paymentStatus', function () {
    var id = $(this).attr('data-id');

    if (this.checked) {
        var status = 'success';
    } else {
        var status = 'pending';
    }
    // alert(id + status);

    $('.loader-overlay').show();
    $.ajax({
        url: "orders/payment/status/" + id + '/' + status,
        method: 'get',
        success: function (result) {
            // console.log(result);
            $('.loader-overlay').hide();
        }

    });

});

// UPDATE CUSTOMER REVIEW STATUS using js...
$('body').on('change', '#customerReviewStatus', function () {
    var id = $(this).attr('data-id');

    if (this.checked) {
        var status = 'visible';
    } else {
        var status = 'hidden';
    }
    // alert(id + status);

    $('.loader-overlay').show();
    $.ajax({
        url: "customers-reviews/status/" + id + '/' + status,
        method: 'get',
        success: function (result) {
            // console.log(result);
            $('.loader-overlay').hide();
        }

    });

});


// DATETIME-PICKER START/END using js...
$('body').on('click', '#datetimepicker', function () {
    // window.alert("hello!");

    $('.date').datetimepicker({
        format:'YYYY-MM-DD hh:mm:ss',
        useCurrent: true,
    });

});


//SLIDER-IMAGE POPUP using jQuery...
$('img').click(function () {
    // alert('Slider Image');

    var slider_image_src = $(this).attr('src');
    // alert(slider_image_src);

    $('.modal').modal('show');
    $('#slider-popup').attr('src', slider_image_src);
});


// WARRANTY BOX SHOW/HIDE using js...
$('body').on('change', 'input[name="warranty"]', function () {
    var val = $(this).val();
    // console.log(val);
    if(val === 'yes') {
        $('.warranty-box').slideDown();
    } else {
        $('.warranty-box').slideUp();
    }

});

// SPECIAL-PRICE BOX SHOW/HIDE using js...
$('body').on('change', 'input[name="special_price"]', function () {
    var val = $(this).val();
    // console.log(val);
    if(val === 'yes') {
        $('.special-price-date-box').slideDown();
    } else {
        $('.special-price-date-box').slideUp();
    }

});

// OFFER-PRICE BOX SHOW/HIDE using js...
$('body').on('change', 'input[name="offer_price"]', function () {
    var val = $(this).val();
    // console.log(val);
    if(val === 'yes') {
        $('.offer-price-date-box').slideDown();
    } else {
        $('.offer-price-date-box').slideUp();
    }

});

// FIND & FETCH CATEGORY WISE SUB-CATEGORY using js...
$('body').on('change', '#category_id', function () {
    var cat_id = $(this).val();
    // console.log(cat_id);

    if(cat_id !== '') {
        $('.loader-overlay').show();
        $.ajax({
            url: SITE_URL_SUPER_ADMIN + "products/find-cat-wise-subcat/" + cat_id,
            method: 'get',
            success: function (result) {
                // console.log(result);
                $('#sub_category_id').html(result);
                $('.loader-overlay').hide();
            }

        });
    }

});


// UPDATE ORIGINAL PRICE USING INPUT FORM using js...
$('body').on('change', '.original_price', function () {
    let id = $(this).attr('data-id');
    // console.log(id);
    var price = $(this).val();
    // console.log(price);

    if(SITE_URL_SUPER_ADMIN) {
        $('.loader-overlay').show();
        $.ajax({
            url: SITE_URL_SUPER_ADMIN + "products/update-original-price/" + id + '/' + price,
            method: 'get',
            success: function (result) {
                // console.log(result);
                $('.loader-overlay').hide();
            }

        });
    }

});

// UPDATE ORIGINAL PRICE USING INPUT FORM using js...
$('body').on('change', '.sales_price', function () {
    let id = $(this).attr('data-id');
    // console.log(id);
    var price = $(this).val();
    // console.log(price);

    if(SITE_URL_SUPER_ADMIN) {
        $('.loader-overlay').show();
        $.ajax({
            data: {
                id: id,
                price: price,
            },
            url: SITE_URL_SUPER_ADMIN + "products/update-sales-price",
            method: 'post',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (result) {
                // console.log(result);
                $('.loader-overlay').hide();
            }

        });
    }

});

// UPDATE ORIGINAL PRICE USING INPUT FORM using js...
$('body').on('change', '.special_price', function () {
    let id = $(this).attr('data-id');
    // console.log(id);
    var price = $(this).val();
    // console.log(price);

    if(SITE_URL_SUPER_ADMIN) {
        $('.loader-overlay').show();
        $.ajax({
            url: SITE_URL_SUPER_ADMIN + "products/update-special-price/" + id + '/' + price,
            method: 'get',
            success: function (result) {
                // console.log(result);
                $('.loader-overlay').hide();
            }

        });
    }

});

// UPDATE ORIGINAL PRICE USING INPUT FORM using js...
$('body').on('change', '.offer_price', function () {
    let id = $(this).attr('data-id');
    // console.log(id);
    var price = $(this).val();
    // console.log(price);

    if(SITE_URL_SUPER_ADMIN) {
        $('.loader-overlay').show();
        $.ajax({
            url: SITE_URL_SUPER_ADMIN + "products/update-offer-price/" + id + '/' + price,
            method: 'get',
            success: function (result) {
                // console.log(result);
                $('.loader-overlay').hide();
            }

        });
    }

});

// File input button customize using js...
$('body').on('click', '.file-click', function() {
    var id = $(this).attr("data-id");
    $('#'+id).click();
});

//  INDEX SINGLE IMAGE Magnify Popup Light-Box...
$('.image').magnificPopup({
    type:'image',
    gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [1, 1]
    },
    mainClass: 'mfp-with-zoom',
    zoom: {
        enabled: true,
        duration: 300
    }
});

//SINGLE IMAGE Magnify Popup Light-Box...
$('.single-image').magnificPopup({ type: 'image' });

//GALLERY IMAGE Magnify Popup LIGHT-BOX...
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$('#gallery-image').magnificPopup({
    delegate: 'a',
    type: 'image',
    gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [1, 1]
    },
    tLoading: 'Loading image #%curr%...'
});

// ORDER DELETE SWEETALERT JS...
$(document).ready(function() {
    $('body').on('click', '#deleteOrder', function (e) {
        e.preventDefault();
        var csrf_token = $("meta[name='csrf-token']").attr('content');
        var id = $(this).data('id');
        // alert(id);

        swal({
            title: "Are you sure?",
            text: "Once Order deleted, you will not be able to recover this Data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    data: {id: id, _token: csrf_token},
                    url: "/super-admin/orders/delete/"+id,
                    type: "DELETE",
                    success: function (response) {
                        // alert(response);
                        swal(response.status, {
                            icon: "success",
                        })
                        .then((result) => {
                            location.reload();
                        });
                    }

                });

            } else {
                swal("Your Order is safe!");
            }

        });
    });

});









