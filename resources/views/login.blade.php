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

        <!-- CSS Files -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/login.css" rel="stylesheet">
        <link href="css/footer.css" rel="stylesheet">

    </head>
    <body>

        <!-- Login Section -->
        <div class="login-container">

            <!-- Logo (Only for desktop) -->
            <div class="login-logo-container-desktop navbar-brand">
                <img src="/images/icon/checkmate_icon.png" width="60" height="60" class="d-inline-block align-top" alt="">
                CheckMate
            </div>

            <!-- Sign in container -->
            <form class="form-signin">

                <!-- Logo (Only used for Mobile) -->
                <img class="mb-4 login-image" src="/images/icon/checkmate_icon.png" alt="" width="72" height="72">

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

        <!-- Footer -->
        <!-- This is a smaller footer used just for the login page -->
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