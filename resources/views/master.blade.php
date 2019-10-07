<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Meta Data -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- JS Files -->
        <script src="js/jquery-3.4.1.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/popper.min.js"></script>

        <!-- CSS Files -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/navbar.css" rel="stylesheet">

        <!-- Fonts -->
        
    </head>
    <body>
        <!-- Nav Bar -->

        <!-- End Of Nav Bar -->

        <!-- The Dynamic Content -->
        @yield ('dynamic-content')
        <!-- End of Dynamic Content -->

        <!-- Footer -->

        <!-- End Of Footer -->
    </body>
</html>