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

            <!-- Delete Button -->
            <a href="#" data-toggle="modal" data-target="#confirmation-modal">
                <img src="{{ Storage::url('/images/icon/dropdown-trash.png') }}" />
                Delete
            </a>
        </div>
    @endif
</div>

<!-- Modal -->
@include('components.form.confirmation-modal', ['route'=> route('module.delete', ['module_id' => $module->id])])