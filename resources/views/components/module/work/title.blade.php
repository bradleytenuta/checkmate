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

    <!-- Icon to show all open courseworks and all closed courseworks -->
    <div class="work-title-badge card-open badge badge-secondary">{{ sizeof($module->openCourseworks()) }}</div>
    <div class="work-title-badge card-closed badge badge-secondary">{{ sizeof($module->closedCourseworks()) }}</div>

    <!-- Buttons -->
    @if (Auth::user()->hasModulePermission(5, $module) || Auth::user()->hasAdminRole())
        <a href="{{ route('module.edit.show', ['id' => $module->id]) }}" type="button" class="btn btn-primary work-title-button">
            Edit
        </a>
    @endif
    @if (Auth::user()->hasModulePermission(6, $module) || Auth::user()->hasAdminRole())
        <a href="#" type="button" class="btn btn-danger work-title-button">
            <img class="work-title-button-image" src="{{ Storage::url('/images/icon/trash-solid.png') }}" />
            Delete
        </a>
    @endif
</div>