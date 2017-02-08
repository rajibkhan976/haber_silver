<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>{!! $pageTitle or "Welcome to Haber Silver" !!}</title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ elixir('assets/css/web-theme/bootstrap.min.css') }}" />
    <!-- font-awesome core CSS -->
    <link rel="stylesheet" href="{{ elixir('assets/css/web-theme/font-awesome.min.css') }}" />
    <!-- Animation core CSS -->
    <link rel="stylesheet" href="{{ elixir('assets/css/web-theme/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ elixir('assets/css/web-theme/lightbox.min.css') }}" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ elixir('assets/css/web-theme/style.css') }}" />
    {{--<link rel="stylesheet" href="{{ elixir('assets/css/web-theme/web.css') }}" />--}}

    <!-- modernizr -->
    <script src="{{ elixir('assets/js/web-theme/modernizr.js') }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!-- JavaScript -->
    <script src="{{ elixir('assets/js/admin-theme/html5shiv.js') }}"></script>
    <script src="{{ elixir('assets/js/admin-theme/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body>

@include('web::layouts.header')

@if(isset($banner))
    @include('web::layouts.banner')
@endif

<!-- Page Content -->
<div class="container">

    @yield('content')

</div>
<!-- /.container -->
<!-- Footer -->
@include('web::layouts.footer')
<!-- jQuery -->
<script src="{{ elixir('assets/js/web-theme/jquery-3.1.1.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ elixir('assets/js/web-theme/bootstrap.min.js') }}"></script>
<!-- Custom Plugin -->
<script src="{{ elixir('assets/js/web-theme/bannerani.js') }}"></script>
<script src="{{ elixir('assets/js/web-theme/lightbox.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('.product-carousel').carousel({

            interval: 2500
        });

        $('.sidebar-nav  a[data-toggle="tooltip"]').tooltip({
            animated: 'fade',
            placement: 'right',
            html: true
        });

        ////// -------- product-carousel-------------////
        $('#myCarousel').carousel({
            interval: 5000
        });

        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
            var id_selector = $(this).attr("id");
            try {
                var id = /-(\d+)$/.exec(id_selector)[1];
                console.log(id_selector, id);
                jQuery('#myCarousel').carousel(parseInt(id));
            } catch (e) {
                console.log('Regex failed!', e);
            }
        });
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
            var id = $('.item.active').data('slide-number');
            $('#carousel-text').html($('#slide-content-'+id).html());
        });

        ////// -------- product-carousel-------------////
        $('.product-carousel').carousel({

            interval: 2500
        });

        ////// -------- tooltip-------------////

        $('.sidebar-nav  a[data-toggle="tooltip"]').tooltip({
            animated: 'fade',
            placement: 'right',
            html: true
        });



        // -------- tooltip-------------////
        $(function () {
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            });
        });




    });




</script>
</body>
</html>