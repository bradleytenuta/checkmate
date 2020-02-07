<div class="card-body">

    <!-- Card Title -->
    <h5>{{ $module->name }}</h5>

    <!-- Card info icons -->
    <div class="card-info-container">

        <!-- Icon to show all open courseworks and all closed courseworks -->
        <div class="card-info-element card-open badge badge-secondary">{{ sizeof($module->openCourseworks()) }}</div>
        <div class="card-info-element card-closed badge badge-secondary">{{ sizeof($module->closedCourseworks()) }}</div>

        <!-- Icon to show role within module -->
        <img 
            class="card-info-element"
            src="{{ Storage::url(Auth::user()->getModulePermissionIconPath($module)) }}"
            data-toggle="tooltip"
            data-placement="bottom"
            title="{{ Auth::user()->getModulePermissionText($module) }}" />

        <!-- Show how many total courseworks -->
        <div
            class="card-info-element card-number-of-courseworks"
            data-toggle="tooltip"
            data-placement="bottom"
            title="Open Courseworks">
            <img src="{{ Storage::url('/images/icon/coursework.png') }}"/>
            <p>{{ sizeof($module->courseworks) }}</p>
        </div>
    </div>

    <!-- Card Description -->
    <p class="card-text">{{ $module->description }}</p>

    <!-- Links to open module -->
    <a href="{{ route('module.show', ['id' => $module->id]) }}" class="card-link">Open</a>

    <!-- If the user has the option to edit the module -->
    @if (\App\Utility\ModulePermission::hasPermission(5, $module, Auth::user()) || Auth::user()->hasAdminRole())
        <a href="{{ route('module.edit.show', ['id' => $module->id]) }}" class="card-link">Edit</a>
    @endif
</div>