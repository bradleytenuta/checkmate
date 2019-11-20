@extends ('layouts.master')

<!-- Begining of head js section -->
@section ('master-head-js')
<script src="js/navbar.js"></script>
@endsection
<!-- End of head js section -->

<!-- Begining of the head css section -->
@section ('master-head-css')
<link href="css/navbar.css" rel="stylesheet">
<link href="css/register.css" rel="stylesheet">
@endsection
<!-- End of the head css section -->

<!-- Begining of the dynamic Section-->
<!-- Just adds the navbar and then yeilds space for other views to inherit -->
@section ('dynamic-master-content')

<!-- Navbar -->
<div class="nav-width-extension bg-light"></div>
<nav class="navbar navbar-light bg-light">

    <!-- Brand --> 
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="/images/icon/checkmate_icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
        CheckMate
    </a>

    <ul class="nav justify-content-end">

        <!-- Admin drop down. Only shown if the user has the correct permissions -->
        @if (Auth::user()->hasAdminPrivileges())
            <li class="nav-item dropdown">
                <a class="nav-link navbar-brand dropdown-toggle" href="#" id="navBarDropDownAdmin"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    onmouseover="hover(this);" onmouseout="unhover(this);">
                    <img src="/images/navbar/plus-circle.png" width="30" height="30" class="d-inline-block align-top" alt="">
                </a>

                <!-- Loops through each permission and adds it to the drop down -->
                <div class="dropdown-menu dropdown-menu-right dropdown-container" aria-labelledby="navBarDropDownAdmin">
                    @foreach ($user->globalPrivilege->globalRole->permissions as $permission)

                        <a class="dropdown-item" href="#" onmouseover="hover(this);" onmouseout="unhover(this);">
                            {{ $permission->name }}
                        </a>

                    @endforeach
                </div>
            </li>
        @endif

        <!-- User Related Content -->
        <li class="nav-item dropdown">
            <a class="nav-link navbar-brand dropdown-toggle" href="#" id="navBarDropDownUser"
            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            onmouseover="hover(this);" onmouseout="unhover(this);">
                <img src="/images/navbar/user.png" width="30" height="30" class="d-inline-block align-top" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-container" aria-labelledby="navBarDropDownUser">
                <!-- User account -->
                <a class="dropdown-item" href="#" onmouseover="hover(this);" onmouseout="unhover(this);">
                    <img src="/images/navbar/user-cog.png" width="24" height="24" class="d-inline-block align-top" alt="">
                    {{ __('Account') }}
                </a>
                <!-- Logout button and form -->
                <a class="dropdown-item" href="#" onmouseover="hover(this);"
                    onmouseout="unhover(this);" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="/images/navbar/sign-out.png" width="24" height="24" class="d-inline-block align-top" alt="">
                    {{ __('Log Off') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>

      </ul>
</nav>
<!-- End Of Navbar -->

<!-- The Dynamic main Content -->
@yield ('dynamic-main-content')
<!-- End of Dynamic main Content -->

<!-- End of the dynamic Section-->
@endsection