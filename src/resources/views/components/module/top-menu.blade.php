<div class="top-menu-container">
    <!-- Includes Breadcrumb -->
    @include('components.breadcrumb.module-breadcrumb')

    <!-- DropDown button -->
    @if (\App\Utility\ModulePermission::hasRole($module, Auth::user(), "professor"))
        <button id="top-menu-module-button" type="button" class="checkmate-button top-menu-button" onclick="openDropDown('top-menu-module-dropdown')">
            <img src="{{ Storage::url('/images/icon/dropdown-menu.png') }}" />
        </button>

        <!-- Module Action dropdown items -->
        <div class="navbar-dropdown top-menu-dropdown" id="top-menu-module-dropdown">
            <a href="{{ route('module.edit.show', ['module_id' => $module->id]) }}">
                <img src="{{ Storage::url('/images/icon/dropdown-edit.png') }}" />
                Edit
            </a>

            <a href="{{ route('coursework.create.show', ['module_id' => $module->id]) }}">
                <img src="{{ Storage::url('/images/icon/coursework.png') }}" />
                Create Coursework
            </a>

            <!-- TODO: Add are you sure? message -->
            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                <img src="{{ Storage::url('/images/icon/dropdown-trash.png') }}" />
                Delete
            </a>
            <form id="delete-form" action="{{ route('module.delete', ['module_id' => $module->id]) }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    @endif
</div>