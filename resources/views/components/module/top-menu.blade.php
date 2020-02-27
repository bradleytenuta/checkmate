<div class="top-menu-container">
    <!-- Includes Breadcrumb -->
    @include('components.breadcrumb.module-breadcrumb')

    <!-- DropDown button -->
    @if (!\App\Utility\ModulePermission::isStudentAdmin($module))
        <button id="top-menu-module-button" type="button" class="checkmate-button top-menu-button" onclick="openDropDown('top-menu-module-dropdown')">
            <img src="{{ Storage::url('/images/icon/dropdown-menu.png') }}" />
        </button>
    @endif

    <!-- Module Action dropdown items -->
    <div class="navbar-dropdown top-menu-dropdown" id="top-menu-module-dropdown">

        @if (\App\Utility\ModulePermission::canEdit($module))
            <a href="{{ route('module.edit.show', ['module_id' => $module->id]) }}">
                <img src="{{ Storage::url('/images/icon/dropdown-edit.png') }}" />
                Edit
            </a>
        @endif

        @if (\App\Utility\CourseworkPermission::canCreate($module))
            <a href="{{ route('coursework.create.show', ['module_id' => $module->id]) }}">
                <img src="{{ Storage::url('/images/icon/coursework.png') }}" />
                Create Coursework
            </a>
        @endif

        <!-- TODO: Add are you sure? message -->
        @if (\App\Utility\ModulePermission::canDelete($module))
            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                <img src="{{ Storage::url('/images/icon/dropdown-trash.png') }}" />
                Delete
            </a>
            <form id="delete-form" action="{{ route('module.delete', ['module_id' => $module->id]) }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endif
    </div>
</div>