const SITE_URL = 'http://lara-ecom.sonjoy/';

//FETCH AND LOAD MORE SUB CATEGORY WISE ( GRID STYLE ) PRODUCTS using Ajax call...
function loadSubCatProduct() {
    var token = $("meta[name='csrf-token']").attr('content');
    // alert(token);
    var sub_cat_id = $("input[name='sub_cat_id']").val();
    // var slug = $("input[name='subCatSlug']").val();

    function loadSubCatData(id = '', token) {
        // alert('Id : ' + id + ' & ' + 'Token : ' + token);
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
