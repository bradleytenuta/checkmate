<div class="top-menu-container">
    <!-- Includes Breadcrumb -->
    @include('components.breadcrumb.coursework-breadcrumb', ['coursework' => $coursework])

    <!-- DropDown button -->
    @if (\App\Utility\ModulePermission::hasRole($module, Auth::user(), "professor"))
        <button id="top-menu-coursework-button" type="button" class="checkmate-button top-menu-button" onclick="openDropDown('top-menu-coursework-dropdown')">
            <img src="{{ Storage::url('/images/icon/dropdown-menu.png') }}" />
        </button>

        <!-- Coursework Action dropdown items -->
        <div class="navbar-dropdown top-menu-dropdown" id="top-menu-coursework-dropdown">
            <a href="{{ route('coursework.edit.show', ['module_id' => $module->id, 'coursework_id' => $coursework->id]) }}">
                <img src="{{ Storage::url('/images/icon/dropdown-edit.png') }}" />
                Edit
            </a>

            <!-- TODO: Add are you sure? message -->
            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                <img src="{{ Storage::url('/images/icon/dropdown-trash.png') }}" />
                Delete
            </a>
            <form id="delete-form" action="{{ route('coursework.delete', ['module_id' => $module->id, 'coursework_id' => $coursework->id]) }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    @endif
</div>