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
    