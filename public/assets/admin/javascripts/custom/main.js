
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


