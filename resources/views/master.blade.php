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
        @yield ('master-head-js')

        <!-- CSS Files -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/master.css" rel="stylesheet">
        <link href="css/footer.css" rel="stylesheet">
        @yield ('master-head-css')

    </head>
    <body>
        <!-- The Dynamic Content -->
        @yield ('dynamic-master-content')
        <!-- End of Dynamic Content -->

        <!-- Footer -->
        <footer class="footer-container footer-margin">

            <!-- Links -->
            <div class="footer-copyright text-center py-3">

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/in/bradley-tenuta">
                    <img src="images/footer/linkedin-icon.png" width="40" height="40" class="d-inline-block align-top" alt=""/>
                </a>

                <!-- Bitbucket -->
                <a href="https://bitbucket.org/BradBitt">
                    <img src="images/footer/bitbucket-icon.png" width="40" height="40" class="d-inline-block align-top" alt=""/>
                </a>

            </div>

            <!-- Version -->
            <div class="footer-copyright text-center py-3">Version 1.0.0</div>

        </footer>
        <!-- End Of Footer -->
    </body>
</html>