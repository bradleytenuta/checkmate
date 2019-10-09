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
        <script src="js/navbar.js"></script>

        <!-- CSS Files -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/master.css" rel="stylesheet">
        <link href="css/navbar.css" rel="stylesheet">
        <link href="css/footer.css" rel="stylesheet">

    </head>
    <body>
        <!-- Navbar -->
        <div class="nav-width-extension bg-light"></div>
        <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">

            <!-- Brand --> 
            <a class="navbar-brand" href="#">
                <img src="/images/icon/checkmate_icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
                CheckMate
            </a>

            <!-- Navbar mobile button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarToggle" aria-controls="navbarToggle"]
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navbar contents -->
            <div class="collapse navbar-collapse navbar-contents-container" id="navbarToggle">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 navbar-contents">
                
                    <!-- Navigation -->
                    <li class="nav-item">
                        <a class="nav-link navbar-brand" href="/home"
                            onmouseover="hover(this);" onmouseout="unhover(this);">
                            <img src="/images/navbar/home.png" width="30" height="30" class="d-inline-block align-top" alt="">
                            Home
                        </a>
                    </li>

                    <!-- Admin drop down. Shall only be shown if admin -->
                    <li class="nav-item dropdown">
                        <a class="nav-link navbar-brand dropdown-toggle" href="#" id="navBarDropDownAdmin"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            onmouseover="hover(this);" onmouseout="unhover(this);">
                            <img src="/images/navbar/plus-circle.png" width="30" height="30" class="d-inline-block align-top" alt="">
                            Admin
                        </a>
                        <div class="dropdown-menu dropdown-container" aria-labelledby="navBarDropDownAdmin">
                            <a class="dropdown-item" href="#" onmouseover="hover(this);" onmouseout="unhover(this);">
                                <img src="/images/navbar/module.png" width="24" height="24" class="d-inline-block align-top" alt="">
                                Create Module
                            </a>
                            <a class="dropdown-item" href="#" onmouseover="hover(this);" onmouseout="unhover(this);">
                                <img src="/images/navbar/coursework.png" width="24" height="24" class="d-inline-block align-top" alt="">
                                Create Coursework
                            </a>
                        </div>
                    </li>

                    <!-- User Related Content -->
                    <li class="nav-item dropdown">
                        <a class="nav-link navbar-brand dropdown-toggle" href="#" id="navBarDropDown"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        onmouseover="hover(this);" onmouseout="unhover(this);">
                            <img src="/images/navbar/user.png" width="30" height="30" class="d-inline-block align-top" alt="">
                            User
                        </a>
                        <div class="dropdown-menu dropdown-container" aria-labelledby="navBarDropDown">
                            <a class="dropdown-item" href="#" onmouseover="hover(this);" onmouseout="unhover(this);">
                                <img src="/images/navbar/user-cog.png" width="24" height="24" class="d-inline-block align-top" alt="">
                                Account
                            </a>
                            <a class="dropdown-item" href="#" onmouseover="hover(this);" onmouseout="unhover(this);">
                                <img src="/images/navbar/sign-out.png" width="24" height="24" class="d-inline-block align-top" alt="">
                                Log Off
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Of Navbar -->

        <!-- The Dynamic Content -->
        @yield ('dynamic-content')
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