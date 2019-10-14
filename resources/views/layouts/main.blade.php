@extends ('master')

<!-- Begining of head js section -->
@section ('master-head-js')
<script src="js/navbar.js"></script>
@endsection
<!-- End of head js section -->

<!-- Begining of the head css section -->
@section ('master-head-css')
<link href="css/navbar.css" rel="stylesheet">
@endsection
<!-- End of the head css section -->

<!-- Begining of the dynamic Section-->
<!-- Just adds the navbar and then yeilds space for other views to inherit -->
@section ('dynamic-master-content')

<!-- Navbar -->
<div class="nav-width-extension bg-light"></div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <!-- Brand --> 
    <a class="navbar-brand" href="#">
        <img src="/images/icon/checkmate_icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
        CheckMate
    </a>

    <!-- Navbar mobile button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#navbarToggle" aria-controls="navbarToggle"
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
                    {{ __('User') }}
                </a>
                <div class="dropdown-menu dropdown-container" aria-labelledby="navBarDropDown">

                    <!-- User account -->
                    <a class="dropdown-item" href="#" onmouseover="hover(this);" onmouseout="unhover(this);">
                        <img src="/images/navbar/user-cog.png" width="24" height="24" class="d-inline-block align-top" alt="">
                        {{ __('Account') }}
                    </a>

                    <!-- Logout button and form -->
                    <a class="dropdown-item" href="#" onmouseover="hover(this);"
                        onmouseout="unhover(this);" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">>
                        <img src="/images/navbar/sign-out.png" width="24" height="24" class="d-inline-block align-top" alt="">
                        {{ __('Log Off') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- End Of Navbar -->

<!-- The Dynamic main Content -->
@yield ('dynamic-main-content')
<!-- End of Dynamic main Content -->

<!-- End of the dynamic Section-->
@endsection