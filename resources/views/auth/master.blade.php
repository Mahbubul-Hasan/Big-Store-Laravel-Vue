<!DOCTYPE HTML>
<html lang="">
<head>
    <title>Authentication || {{ config("app.name") }}</title>
    <!-- Custom Theme files -->
    <link href="/auth/css/bootstrap.css" rel="stylesheet"/>
    <link href="/auth/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- Custom Theme files -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Flat New Login Form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <!--Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!--Google Fonts-->
    <script>var __links = document.querySelectorAll('a');function __linkClick(e) { parent.window.postMessage(this.href, '*');} ;for (var i = 0, l = __links.length; i < l; i++) {if ( __links[i].getAttribute('data-t') == '_blank' ) { __links[i].addEventListener('click', __linkClick, false);}}</script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>$(document).ready(function(c) {
            $('.sinup-close').on('click', function(c){
                $('.setting').fadeOut('slow', function(c){
                    $('.setting').remove();
                });
            });
        });
    </script>
</head>
<body>
<!--login start here-->
<div class="login">

    @yield("content")

</div>
<!--login end here-->
</body>
</html>
