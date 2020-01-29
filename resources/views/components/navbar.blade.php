<!-- TODO: Redo this -->
<!-- Navbar -->
<div class="nav-width-extension bg-light"></div>
<nav class="navbar navbar-light bg-light">

    <!-- Brand --> 
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ Storage::url('/images/icon/checkmate_icon.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
        CheckMate
    </a>

    <ul class="nav justify-content-end">

        <!-- Admin drop down. Only shown if the user has the correct permissions -->
        @if (Auth::user()->hasAdminRole())
            <li class="nav-item dropdown">
                <a class="nav-link navbar-brand dropdown-toggle" href="#" id="navBarDropDownAdmin"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    onmouseover="hover(this);" onmouseout="unhover(this);">
                    <img src="{{ Storage::url('/images/navbar/plus-circle.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
                </a>

                <!-- Loops through each permission and adds it to the drop down -->
                <div class="dropdown-menu dropdown-menu-right dropdown-container" aria-labelledby="navBarDropDownAdmin">

                    @if (Auth::user()->hasGlobalPermission(1))
                        <a class="dropdown-item" href="{{ route('register') }}" onmouseover="hover(this);" onmouseout="unhover(this);">
                            {{ __('Create User') }}
                        </a>
                    @endif

                    @if (Auth::user()->hasGlobalPermission(4))
                        <a class="dropdown-item" href="{{ route('create.module') }}" onmouseover="hover(this);" onmouseout="unhover(this);">
                            {{ __('Create Module') }}
                        </a>
                    @endif


                </div>
            </li>
        @endif

        <!-- User Related Content -->
        <li class="nav-item dropdown">
            <a class="nav-link navbar-brand dropdown-toggle" href="#" id="navBarDropDownUser"
            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            onmouseover="hover(this);" onmouseout="unhover(this);">
                <img src="{{ Storage::url('/images/navbar/user.png') }}" width="30" height="30" class="d-inline-block align-top" alt=""
                data-toggle="tooltip" data-placement="bottom" title="{{ Auth::user()->firstname }} {{ Auth::user()->surname }}">
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-container" aria-labelledby="navBarDropDownUser">
                <!-- User account -->
                <a class="dropdown-item" href="#" onmouseover="hover(this);" onmouseout="unhover(this);">
                    <img src="{{ Storage::url('/images/navbar/user-cog.png') }}" width="24" height="24" class="d-inline-block align-top" alt="">
                    {{ __('Account') }}
                </a>
                <!-- Logout button and form -->
                <a class="dropdown-item" href="#" onmouseover="hover(this);"
                    onmouseout="unhover(this);" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="{{ Storage::url('/images/navbar/sign-out.png') }}" width="24" height="24" class="d-inline-block align-top" alt="">
                    {{ __('Log Off') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
      </ul>
</nav>