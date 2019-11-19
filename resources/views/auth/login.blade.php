@extends ('layouts.master')
<!-- TODO: Change so it doesnt tell you which one is wrong -->

<!-- Begining of the head css section -->
@section ('master-head-css')
<link href="css/login.css" rel="stylesheet">
@endsection
<!-- End of the head css section -->

<!-- Begining of the dynamic Section-->
@section ('dynamic-master-content')

<!-- Login Section -->
<div class="login-container">

    <!-- Logo (Only for desktop) -->
    <div class="login-logo-container-desktop navbar-brand">
        <img src="/images/icon/checkmate_icon.png" width="60" height="60" class="d-inline-block align-top" alt="">
        {{ __('CheckMate') }}
    </div>

    <!-- Sign in container -->
    <form method="POST" class="form-signin" action="{{ route('login') }}">

        <!-- The csrf-token from the meta-data in head -->
        @csrf

        <!-- Logo (Only used for Mobile) -->
        <img class="mb-4 login-image" src="/images/icon/checkmate_icon.png" alt="" width="72" height="72">

        <!-- Input email -->
        <label for="inputEmail" class="sr-only">{{ __('E-Mail Address') }}</label>
        <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        <!-- Input password -->
        <label for="inputPassword" class="sr-only">{{ __('Password') }}</label>
        <input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">

        <!-- Remember me check box -->
        <div class="checkbox mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>

        <!-- Sign in button -->
        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Sign In') }}</button>

        <!-- Forgot password -->
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>

        <!-- Error Section -->
        @error('email')
            <p class="invalid-feedback" role="alert">{{ $message }}</p>
        @enderror
        @error('password')
            <p class="invalid-feedback" role="alert">{{ $message }}</p>
        @enderror
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

@endsection
<!-- End of the dynamic Section-->