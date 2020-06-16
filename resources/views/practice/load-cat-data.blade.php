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
{{--        @if(count($categories) > 0)--}}
        @if(!$categories->isEmpty())
            <ul>
                @php($i=0)
                @foreach($categories as $category)
                    <li>
                        <a href="#">{{ $category->id  . ' => ' . $category->category_name }}</a>
                    </li>
                    @php($i++)
                @endforeach
                @php($lastCatId = $category->id)
            </ul>

            @if($i > 0)
            <div class="load-cat-button">
                <button type="submit" class="btn btn-success btn-sm" data-id="{{ $lastCatId }}" id="loadCatShowButton">Load More Category</button>
            </div>
            @endif
        @else
            <h2>No Category Found...</h2>
        @endif

    </div>
</div>



<!-- JavaScripts placed at the end of the document so the page-error load faster -->
<script src="{{ asset('assets/site/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('assets/site/js/bootstrap.min.js') }}"></script>
<script>

</script>
</body>
</html>

