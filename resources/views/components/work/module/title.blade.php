<!-- Module title -->
<div class="col-md-6">
    <h1>{{ $module->name }}</h1>
</div>

<!-- Module Admin buttons -->
<div class="col-md-6">

    <!-- Icon -->
    <img 
        class="work-title-icon"
        src="{{ Storage::url(Auth::user()->getModulePermissionIconPath($module)) }}"
        data-toggle="tooltip"
        data-placement="bottom"
        title="{{ Auth::user()->getModulePermissionText($module) }}">

    <!-- Icon to show if the item is open or closed -->
    @if ($module->open == true)
        <div class="work-title-badge card-open badge badge-secondary">Open</div>
    @else
        <div class="work-title-badge card-closed badge badge-secondary">Closed</div>
    @endif

    <!-- Buttons -->
    @if (Auth::user()->hasModulePermission(5, $module))
        <a href="#" type="button" class="btn btn-primary work-title-button">Edit</a>
    @endif
    @if (Auth::user()->hasModulePermission(6, $module))
        <a href="#" type="button" class="btn btn-primary work-title-button">Delete</a>
    @endif
</div>