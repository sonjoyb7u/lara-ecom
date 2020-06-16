<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
    <h3 class="section-title">Newsletters</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div id="error-message" style="display: none;"></div>
        <p>Sign Up for Our Newsletter!</p>
        <form role="form" action="javascript:void(0)" method="post">

            <div class="form-group">
                <label class="sr-only" for="email">Email address</label>
                <input onfocus="enableSubscribeBtn();" onfocusout="checkSubscriber();" type="email" class="form-control" name="email" id="email" placeholder="Subscribe to our newsletter" value="{{ old('email') }}">
            </div>
            <button onclick="checkSubscriber(); addSubscriber();" id="subscribeBtn" type="submit" class="btn btn-primary">Subscribe</button>
        </form>
    </div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->


@push('js')
    <script type="text/javascript">
        // Toastr Message generate js...
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}', 'Error', {
            closeButton: true,
            progressBar: true,
        });
        @endforeach
        @endif

        // Newsletter Subscribe js...
        function checkSubscriber() {
            var token = $("meta[name='csrf-token']").attr('content');
            var email = $('input[name="email"]').val();

            $("#overlay").fadeIn(200);
            $.ajax({
                type: 'POST',
                url: '/check-subscriber',
                data: { email: email, _token: token},
                success:function(response) {
                    // alert(response);
                    if(response == "exists") {
                        $('#error-message').show();
                        $('#subscribeBtn').hide();
                        $('#error-message').html('<div class="alert alert-danger fade in">\n' +
                            '<a href="#" class="close" data-dismiss="alert">&times;</a>\n' +                                    'Exists, This email already been subscribed!\n' + '</div>');
                    }
                    $("#overlay").fadeOut(200);
                },
                error:function() {
                    alert("Error!");
                }

            });
        }

        function enableSubscribeBtn (){
            $('#subscribeBtn').show();
            $('#error-message').hide();
        }

        function addSubscriber() {
            var token = $("meta[name='csrf-token']").attr('content');
            var email = $('input[name="email"]').val();

            $("#overlay").fadeIn(200);
            $.ajax({
                type: 'POST',
                url: '/add-subscriber',
                data: { email: email, _token: token},
                success:function(response) {
                    // alert(response);
                    if(response == "exists") {
                        $('#error-message').show();
                        $('#subscribeBtn').hide();
                        $('#error-message').html('<div class="alert alert-danger fade in">\n' +
                            '<a href="#" class="close" data-dismiss="alert">&times;</a>\n' +                                    'Exists, This email already been subscribed!\n' + '</div>');
                    } else if(response == "saved") {
                        $('#error-message').show();
                        $('#error-message').html('<div class="alert alert-success fade in">\n' +
                            '<a href="#" class="close" data-dismiss="alert">&times;</a>\n' +                                    'Success, Thanks for Subscribing with us.!\n' + '</div>');
                    }
                    $("#overlay").fadeOut(200);
                },
                error:function() {
                    alert("Error!");
                }

            });
        }
    </script>
@endpush
