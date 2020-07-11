const SITE_URL = 'http://lara-ecom.sonjoy/';

//FETCH AND LOAD MORE SUB CATEGORY WISE ( GRID STYLE ) PRODUCTS using Ajax call...
function loadSubCatProduct() {
    var token = $("meta[name='csrf-token']").attr('content');
    // alert(token);
    var sub_cat_id = $("input[name='sub_cat_id']").val();
    // var slug = $("input[name='subCatSlug']").val();

    function loadSubCatData(id = '', token) {
        // alert('Id : ' + id + ' & ' + 'Token : ' + token);
        $("#overlay").fadeIn(300);

        $.ajax({
            data: {id: id, _token: token, sub_cat_id: sub_cat_id},
            url: SITE_URL + 'load-subcat-product',
            method: 'POST',
            // beforeSend: function (request) {
            //     return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            // },
            success:function (results) {
                // console.log(results);
                $('#loadSubCatShowButton').remove();
                $('#loadSubCatProduct').append(results);
                $("#overlay").fadeOut(300);
            }

        });

    }

    loadSubCatData('', token);

    $('body').on('click', '#loadSubCatShowButton', function () {
        var getLastId = $(this).data('id');
        // alert(sub_cat_id);
        $('#loadSubCatShowButton').html('Loading...');
        loadSubCatData(getLastId, token);
    });

}

//FETCH AND LOAD MORE SUB CATEGORY WISE ( LIST STYLE ) PRODUCTS using Ajax call...
function loadSubCatListProduct() {
    var token = $("meta[name='csrf-token']").attr('content');
    // alert(token);
    var sub_cat_id = $("input[name='sub_cat_id']").val();
    // var slug = $("input[name='subCatSlug']").val();

    function loadSubCatListData(id = '', token) {
        // alert('Id : ' + id + ' & ' + 'Token : ' + token);
        $("#overlay").fadeIn(300);

        $.ajax({
            data: {id: id, _token: token, sub_cat_id: sub_cat_id},
            url: SITE_URL + 'load-subcat-list-product',
            method: 'POST',
            // beforeSend: function (request) {
            //     return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            // },
            success:function (results) {
                // console.log(results);
                $('#loadSubCatShowButton').remove();
                $('#loadSubCatListProduct').append(results);
                $("#overlay").fadeOut(300);
            }

        });

    }

    loadSubCatListData('', token);

    $('body').on('click', '#loadSubCatShowButton', function () {
        var getLastId = $(this).data('id');
        // alert(sub_cat_id);
        $('#loadSubCatShowButton').html('Loading...');
        loadSubCatListData(getLastId, token);
    });

}


// Page Loader Raw jQuery Code of Codepen...
// jQuery(function($){
//     $(document).ajaxSend(function() {
//         $("#overlay").fadeIn(300);
//     });
//
//     $('#button').click(function(){
//         $.ajax({
//             type: 'GET',
//             success: function(data){
//                 console.log(data);
//             }
//         }).done(function() {
//             setTimeout(function(){
//                 $("#overlay").fadeOut(300);
//             },500);
//         });
//     });
// });


// UPDATE QUANTITY OF CART SHOW PAGE using js...
// First Way...

$('.quantity').on('change keyup', function () {
    $("#showMsg").hide();
    var token = $("meta[name='csrf-token']").attr('content');
    // console.log(token);
    let id = $(this).attr('data-id');
    // console.log(id);
    var quantity = $(this).val();
    // console.log(quantity);
    var price = $("input[name='price']").val();
    // console.log(price);

    if(quantity > 1) {
        grandTotalPricePlus = quantity * price;
        // console.log(grandTotalPricePlus);

    } else if(quantity <= 1) {
        grandTotalPriceMinus = grandTotalPricePlus - price;
        // console.log(grandTotalPriceMinus);
    }

    $("#overlay").fadeIn(200);
    $.ajax({
        data: {
            id: id,
            quantity: quantity,
            _token: token,
        },
        url: "update",
        method: 'POST',
        // beforeSend: function (request) {
        //     return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        // },
        success: function (result) {
            // console.log(result);
            // $("#showMsg").show();
            // location.reload(true);
            if(quantity > 1) {
                $("#grandTotalPrice").html("&#2547; " + grandTotalPricePlus);

            } else if(quantity <= 1) {
                $("#grandTotalPrice").html("&#2547; " + grandTotalPriceMinus);
            }

            // $("#showMsg").html(result);
            $("#overlay").fadeOut(200);

        }

    });

});



// UPDATE QUANTITY & GRAND TOTAL PRICE OF CART SHOW PAGE USING INPUT FORM using js...
// Second Way...
// $('.quantity').on('change keyup', function() {
//     var token = $("meta[name='csrf-token']").attr('content');
//     // console.log(token);
//     var quantity = $(this).val();
//     // alert(quantity);
//     var product_id = $(this).data('id');
//     // alert(product_id);
//
//
//     $.ajax({
//         url: SITE_URL + 'cart/update',
//         type: 'POST',
//         data: { _token: token, product_id: product_id, quantity: quantity },
//         success:function (response) {
//             // alert(response);
//             $('#grandTotalPrice').html();
//         },
//         error:function () {
//             alert("Error!");
//         }
//     });
//
// });

$('body').on('keyup', '#search', function() {
    var token = $("meta[name='csrf-token']").attr('content');
    let search = $(this).val();

    // $("#search-overlay").fadeIn(300);
    if(search.length > 0) {
        $("#search-overlay").fadeIn(300);
        $.ajax({
            url: SITE_URL + 'search/products',
            type: 'POST',
            data: { _token: token, search: search},
            success:function (response) {
                // alert(response);
                $('#search-result').html(response);
                $("#search-overlay").fadeOut(300);
            },
            error:function () {
                // alert("Error!");
            }
        });
    } else {
        $('#search-result').html('');
    }

});

function search_result_show() {
    $('#search-result').slideDown();
}

function search_result_hide() {
    $('#search-result').slideUp();
}







