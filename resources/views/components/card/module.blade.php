<div class="card-body">

    <!-- Card Title -->
    <h5>{{ $module->name }}</h5>

    <!-- Card info icons -->
    <div class="list-card-info-container">

        <!-- Icon to show role within module -->
        <img 
            class="list-card-info-element"
            src="{{ Storage::url(Auth::user()->getModulePermissionIconPath($module)) }}"
            data-toggle="tooltip"
            data-placement="bottom"
            title="{{ Auth::user()->getModulePermissionText($module) }}" />

        <!-- Icon to show if the item is open or closed -->
        @if ($module->open == true)
            <div class="list-card-info-element list-card-open badge badge-secondary">Open</div>
        @else
            <div class="list-card-info-element list-card-closed badge badge-secondary">Closed</div>
        @endif

        <!-- Show how many open courseworks -->
        @if (Auth::user()->isModule($module))
            <div
                class="list-card-info-element list-card-number-of-courseworks"
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