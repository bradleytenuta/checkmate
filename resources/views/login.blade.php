<!-- This does not extend master. -->
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
        <link href="css/login.css" rel="stylesheet">
        <link href="css/navbar.css" rel="stylesheet">

        <!-- Fonts -->

    </head>
    <body>

        <!-- Navbar -->
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
                    <li class="nav-item" onmouseover="hover(this);" onmouseout="unhover(this);">
                      <a class="nav-link navbar-brand" href="/home">
                        <img src="/images/navbar/home.png" width="30" height="30" class="d-inline-block align-top"
                            alt="" id="navbar-image">
                        Home
                    </a>
                    </li>

                    <!-- Admin drop down. Shall only be shown if admin -->
                    <li class="nav-item dropdown" onmouseover="hover(this);" onmouseout="unhover(this);">
                        <a class="nav-link navbar-brand dropdown-toggle" href="#" id="navBarDropDownAdmin"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="/images/navbar/plus-circle.png" width="30" height="30" class="d-inline-block align-top"
                                alt="" id="navbar-image">
                            Admin
                        </a>
                        <div class="dropdown-menu dropdown-container" aria-labelledby="navBarDropDownAdmin">
                            <a class="dropdown-item" href="#">
                                <img src="/images/navbar/module.png" width="24" height="24" class="d-inline-block align-top" alt="">
                                Create Module
                            </a>
                            <a class="dropdown-item" href="#">
                                <img src="/images/navbar/coursework.png" width="24" height="24" class="d-inline-block align-top" alt="">
                                Create Coursework
                            </a>
                        </div>
                    </li>

                    <!-- User Related Content -->
                    <li class="nav-item dropdown" onmouseover="hover(this);" onmouseout="unhover(this);">
                        <a class="nav-link navbar-brand dropdown-toggle" href="#" id="navBarDropDown"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="/images/navbar/user.png" width="30" height="30" class="d-inline-block align-top"
                                alt="" id="navbar-image">
                            User
                        </a>
                        <div class="dropdown-menu dropdown-container" aria-labelledby="navBarDropDown">
                            <a class="dropdown-item" href="#">
                                <img src="/images/navbar/user-cog.png" width="24" height="24" class="d-inline-block align-top" alt="">
                                Account
                            </a>
                            <a class="dropdown-item" href="#">
                                <img src="/images/navbar/sign-out.png" width="24" height="24" class="d-inline-block align-top" alt="">
                                Log Off
                            </a>
                        </div>
                    </li>
                  </ul>
                </div>

              </nav>
        <!-- End Of Navbar -->

        <!-- Login Section -->
        <div class="login-container">

            <!-- Sign in container -->
            <form class="form-signin">

                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me">
                        Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

                <!-- Create an account anchor -->
                <a href="/signup" class="mt-2 text-muted">Create An Account</a>

            </form>
        </div>
        <!-- End Of Login Section -->

        <!-- Information Section -->
        <div class="container info-container">

            <!-- Three columns of text with images -->
            <div class="row">
                <div class="col-lg-4">
                    <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="images/login/clipboard.png" />
                    <h2>Mark Code</h2>
                    <p>
                        View submitted work in an easy to read code viewer.
                        Features include syntax highlighting and line indention.
                    </p>
                </div>
                <div class="col-lg-4">
                    <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="images/login/running.png" />
                    <h2>Run Tests</h2>
                    <p>
                        Create Unit tests to run on submitted coursework.
                        This enables automatic marking based on test results.
                        Never again waste your time compiling hundreds of work.
                    </p>
                </div>
                <div class="col-lg-4">
                    <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="images/login/send.png" />
                    <h2>Send Feedback</h2>
                    <p>
                        Create comments and reference a line of code.
                        An easy approach to providing helpful feedback on large pieces of work.
                        Once your happy with your review, students can sign in and view your feedback.
                    </p>
                </div>
            </div>

            <!-- START THE FEATURETTES -->
            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">Follow The Development.</h2>
                    <p class="lead">
                        Follow the development made on this application through my bitbucket account.
                        The whole application is under source control and is completely open source.
                    </p>
                    <p>
                        <a class="btn btn-secondary" href="https://bitbucket.org/BradBitt/checkmate/src/master/" role="button" target="_blank">
                            Bitbucket »
                        </a>
                    </p>
                </div>
                <div class="col-md-5">
                    <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto rounded-circle" src="images/login/bitbucket-logo.png" />
                </div>
            </div>
            <!-- /END THE FEATURETTES -->

        </div>
    </body>
</html>