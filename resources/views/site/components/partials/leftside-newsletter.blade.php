<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
    <h3 class="section-title">Newsletters</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <p>Sign Up for Our Newsletter!</p>
        <form role="form" action="javascript:void(0)" method="post">

            <div class="form-group">
                <label class="sr-only" for="email">Email address</label>
                <input onfocusout="checkSubscriber();" type="email" class="form-control" name="email" id="email" placeholder="Subscribe to our newsletter">
            </div>
            <button type="submit" class="btn btn-primary">Subscribe</button>
        </form>
    </div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->


@push('js')
    <script type="text/javascript">
        function checkSubscriber() {
            var token = $("meta[name='csrf-token']").attr('content');
            var email = $('input[name="email"]').val();

            $("#overlay").fadeIn(200);
            $.ajax({
                type: 'POST',
                url: '/newsletter-subscriber',
                data: { email: email, _token: token},
                success:function(response) {
                    alert(response);
                    $("#overlay").fadeOut(200);
                },
                error:function() {
                    alert("Error!");
                }

            });
        }
    </script>
@endpush
