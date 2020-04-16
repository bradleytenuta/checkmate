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

            <!-- Delete Button -->
            <a href="#" data-toggle="modal" data-target="#confirmation-modal">
                <img src="{{ Storage::url('/images/icon/dropdown-trash.png') }}" />
                Delete
            </a>
        </div>
    @endif
</div>

<!-- Modal -->
@include('components.form.confirmation-modal', ['route'=> route('coursework.delete', ['module_id' => $module->id, 'coursework_id' => $coursework->id])])