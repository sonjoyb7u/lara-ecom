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

        <div id="fetchCatData" class="text-center"></div>

    </div>
</div>



<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="{{ asset('assets/site/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('assets/site/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/javascripts/custom/main.js') }}"></script>
<script>
    fatchCatData();
</script>
</body>
</html>
