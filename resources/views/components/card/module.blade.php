<div class="card-body">

    <!-- Card Title -->
    <h5>{{ $module->name }}</h5>

    <!-- Card info icons -->
    <div class="card-info-container">

        <!-- Icon to show all open courseworks and all closed courseworks -->
        <div class="card-info-element card-open badge badge-secondary">{{ Auth::user()->getOpenCourseworksNumber($module) }}</div>
        <div class="card-info-element card-closed badge badge-secondary">{{ Auth::user()->getClosedCourseworksNumber($module) }}</div>

        <!-- Icon to show role within module -->
        <img 
            class="card-info-element"
            src="{{ Storage::url(Auth::user()->getModulePermissionIconPath($module)) }}"
            data-toggle="tooltip"
            data-placement="bottom"
            title="{{ Auth::user()->getModulePermissionText($module) }}" />

        <!-- Show how many open courseworks -->
        @if (Auth::user()->isModule($module))
            <div
                class="card-info-element card-number-of-courseworks"
                data-toggle="tooltip"
                data-placement="bottom"
                title="Open Courseworks">
                <img src="{{ Storage::url('/images/navbar/coursework.png') }}"/>
                <p>{{ sizeof(Auth::user()->getOpenCourseworks($module)) }}</p>
            </div>
        @endif
    </div>

    <!-- Card Description -->
    <p class="card-text">{{ $module->description }}</p>

    <!-- Links to open module -->
    <a href="{{ route('module.show', ['id' => $module->id]) }}" class="card-link">Open</a>

    <!-- If the user has the option to edit the module -->
    @if (Auth::user()->hasModulePermission(5, $module))
        <a href="#" class="card-link">Edit</a>
    @endif
</div>