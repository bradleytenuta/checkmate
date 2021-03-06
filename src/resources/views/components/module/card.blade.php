<div class="card-body">

    <!-- Card Title -->
    <h5>{{ $module->name }}</h5>

    <!-- Card info icons -->
    <div class="card-info-container">

        <!-- Icon to show all open courseworks and all closed courseworks -->
        <div class="card-info-element card-open badge badge-secondary" title="Open Courseworks">{{ sizeof($module->openCourseworks()) }}</div>
        <div class="card-info-element card-closed badge badge-secondary" title="Closed Courseworks">{{ sizeof($module->closedCourseworks()) }}</div>
        <div class="card-info-element card-pending badge badge-secondary" title="Pending Courseworks">{{ sizeof($module->pendingCourseworks()) }}</div>

        <!-- Icon to show role within module -->
        <img 
            class="card-info-element"
            src="{{ Storage::url(\App\Utility\ModulePermission::permissionIconPath($module, Auth::user())) }}"
            data-toggle="tooltip"
            data-placement="bottom"
            title="{{ \App\Utility\ModulePermission::permissionText($module, Auth::user()) }}" />

        <!-- Show how many total courseworks -->
        <div
            class="card-info-element card-number-of-courseworks"
            data-toggle="tooltip"
            data-placement="bottom"
            title="Number of Courseworks">
            <img src="{{ Storage::url('/images/icon/coursework.png') }}"/>
            <p>{{ sizeof($module->courseworks) }}</p>
        </div>
    </div>

    <!-- Card Description -->
    <p class="card-text">{{ $module->description }}</p>

    <!-- Links to open module -->
    @if (\App\Utility\ModulePermission::canShow($module))
        <a href="{{ route('module.show', ['module_id' => $module->id]) }}" class="card-link">Open</a>
    @endif

    <!-- If the user has the option to edit the module -->
    @if (\App\Utility\ModulePermission::canEdit($module))
        <a href="{{ route('module.edit.show', ['module_id' => $module->id]) }}" class="card-link">Edit</a>
    @endif
</div>