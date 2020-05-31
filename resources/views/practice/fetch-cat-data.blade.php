<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Load More Data Using Ajax Call</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container">
    <div class="row">
        <h2 class="text-center bg-info" style="padding: 20px;">Load More SubCat Data Using Ajax Call</h2>

        <div id="loadSubCatProduct" class="text-center"></div>

    </div>
</div>



<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="{{ asset('assets/site/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('assets/site/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/site/custom/custom.js') }}"></script>
<script>
    // loadSubCatProduct();

    var token = $("meta[name='csrf-token']").attr('content');
    // alert(token);

    function loadSubCatData(id = '', token) {
        // alert('Id : ' + id + ' & ' + 'Token : ' + token);
        $.ajax({
            url: 'fetch-cat-data',
            method: 'POST',
            // beforeSend: function (request) {
            //     return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            // },
            data: {id: id, _token: token},
            success:function (results) {
                // console.log(results);
                $('#loadCatShowButton').remove();
                $('#loadSubCatProduct').append(results);
            }

        });

    }

    loadSubCatData('', token);

    $('body').on('click', '#loadCatShowButton', function () {
        var sub_cat_id = $(this).data('id');
        // alert(sub_cat_id);
        $('#loadSubCatProduct').html('Loading...');
        loadSubCatData(sub_cat_id, token);
    });
</script>
</body>
</html>
