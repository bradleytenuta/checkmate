<nav class="navbar">
    <div class="navbar-fluid-container">

        <!-- Logo Container -->
        <a class="navbar-logo navbar-brand" href="{{ route('home') }}">
            <img src="{{ Storage::url('/images/icon/checkmate_icon.png') }}" alt="Logo">
        </a>

        <!-- Empty Divider Container -->
        <div class="navbar-divider"></div>

        <!-- Navbar Buttons -->
        <div class="navbar-button-container">

            <!-- Admin button -->
            @if (Auth::user()->hasAdminRole())
                <button id="navbar-admin-button" type="button" class="checkmate-button" onclick="openNavDropDown('navbar-admin-dropdown')">
                    <img src="{{ Storage::url('/images/navbar/plus-circle.png') }}" />
                </button>
            @endif

            <!-- User button -->
            <button id="navbar-user-button" type="button" class="checkmate-button" onclick="openNavDropDown('navbar-user-dropdown')">
                <img src="{{ Storage::url('/images/navbar/user.png') }}" />
            </button>
        </div>

        <!-- Navbar dropdowns -->
        <!-- Admin dropdown -->
        <div class="navbar-dropdown" id="navbar-admin-dropdown">
            @if (Auth::user()->hasGlobalPermission(1))
                <a href="{{ route('register') }}">
                    <img src="{{ Storage::url('/images/navbar/user-cog.png') }}" />
                    Create User
                </a>
            @endif

            @if (Auth::user()->hasGlobalPermission(4))
                <a href="{{ route('module.create.show') }}">
                    <img src="{{ Storage::url('/images/navbar/module.png') }}" />
                    Create Module
                </a>
            @endif
        </div>
        <!-- User dropdown -->
        <div class="navbar-dropdown" id="navbar-user-dropdown">
            <a href="{{ route('user.edit.show') }}">
                <img src="{{ Storage::url('/images/navbar/user-cog.png') }}" />
                Account
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <img src="{{ Storage::url('/images/navbar/sign-out.png') }}" />
                Log Off
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>