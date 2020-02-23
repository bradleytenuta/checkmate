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
                    <img src="{{ Storage::url('/images/icon/crown-solid.png') }}" />
                </button>
            @endif

            <!-- User button -->
            <button id="navbar-user-button" type="button" class="checkmate-button" onclick="openNavDropDown('navbar-user-dropdown')">
                <img src="{{ Storage::url('/images/icon/user.png') }}" />
            </button>
        </div>

        <!-- Navbar dropdowns -->
        <!-- Admin dropdown -->
        <div class="navbar-dropdown" id="navbar-admin-dropdown">
            @if (Auth::user()->hasAdminRole())
                <a href="{{ route('register') }}">
                    <img src="{{ Storage::url('/images/icon/user-cog.png') }}" />
                    Create User
                </a>
                <a href="{{ route('user.delete.show') }}">
                    <img src="{{ Storage::url('/images/icon/user-minus-solid.png') }}" />
                    Delete User
                </a>
                <a href="{{ route('module.create.show') }}">
                    <img src="{{ Storage::url('/images/icon/module.png') }}" />
                    Create Module
                </a>
                <a href="{{ route('module.show.all') }}">
                    <img src="{{ Storage::url('/images/icon/module.png') }}" />
                    All Modules
                </a>
            @endif
        </div>
        <!-- User dropdown -->
        <div class="navbar-dropdown" id="navbar-user-dropdown">
            <a href="{{ route('user.edit.show') }}">
                <img src="{{ Storage::url('/images/icon/user-cog.png') }}" />
                Account
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <img src="{{ Storage::url('/images/icon/sign-out.png') }}" />
                Log Off
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>