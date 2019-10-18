<!DOCTYPE HTML>
<html>

<head>
    <title>{{ config("app.name") }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Fashionpress Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <link href="front/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Custom Theme files -->
    <link href="front/css/style.css" rel='stylesheet' type='text/css' />
    <link href="front/css/flexslider.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="front/css/cart.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- Custom Theme files -->
    <!--webfont-->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="front/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="front/js/responsiveslides.min.js"></script>
    <script type="text/javascript" src="front/js/hover_pack.js"></script>
    
    <script>
        $(function () {
          $("#slider").responsiveSlides({
              auto: true,
              nav: true,
              speed: 500,
            namespace: "callbacks",
            pager: true,
          });
        });
    </script>
    <script type="text/javascript" src="front/js/jquery-2.1.4.min.js"></script>
        <!-- imagezoom -->
    <script type="text/javascript" src="front/js/imagezoom.js"></script>
        <!-- //imagezoom -->
    <script type="text/javascript" defer src="front/js/jquery.flexslider.js"></script>
    <script>
        // Can also be used with $(document).ready()
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
        });
    </script>

<script  type="text/javascript" src="front/js/easyResponsiveTabs.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true   // 100% fit in a container
        });
    });
</script>

    
</head>

<body>
    <div id="app">
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>
        @include('front.footer')
    </div>
    <script src="js/app.js"></script>
</body>

</html>
