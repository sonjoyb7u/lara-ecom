@if ($errors->any())
    <div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{--@if(session('message_name'))--}}
{{--<div class="alert alert-danger">--}}
{{--{{ session('message_name') }}--}}
{{--</div>--}}
{{--@endif--}}

@if(session()->has('message'))
    <div class="alert alert-{{ session('type') }} fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {{ session('message') }}
    </div>
@endif

@if(session()->has('message'))
<div class="alert alert-{{ session('type') }} fade in" id="showMsg">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    {{ session('message') }}
</div>
@endif

