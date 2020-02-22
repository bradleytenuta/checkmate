<!-- Module title -->
<div class="col-md-6">
    <h1>{{ $module->name }}</h1>
</div>

<!-- Module Admin buttons -->
<div class="col-md-6">

    <!-- Icon -->
    <img 
        class="page-title-icon"
        src="{{ Storage::url(\App\Utility\ModulePermission::permissionIconPath($module, Auth::user())) }}"
        data-toggle="tooltip"
        data-placement="bottom"
        title="{{ \App\Utility\ModulePermission::permissionText($module, Auth::user()) }}">

    <!-- Icon to show all open courseworks and all closed courseworks -->
    <div class="page-title-badge card-open badge badge-secondary" title="Open Courseworks">{{ sizeof($module->openCourseworks()) }}</div>
    <div class="page-title-badge card-closed badge badge-secondary" title="Closed Courseworks">{{ sizeof($module->closedCourseworks()) }}</div>
    <div class="page-title-badge card-pending badge badge-secondary" title="Pending Courseworks">{{ sizeof($module->pendingCourseworks()) }}</div>

    <!-- Buttons -->
    @if (\App\Utility\ModulePermission::canEdit($module))
        <a href="{{ route('module.edit.show', ['module_id' => $module->id]) }}" type="button" class="btn btn-primary page-title-button">
            Edit
        </a>
    @endif

    @if (\App\Utility\CourseworkPermission::canCreate($module))
        <a href="{{ route('coursework.create.show', ['module_id' => $module->id]) }}" type="button" class="btn btn-primary page-title-button">
            <img class="page-title-button-image" src="{{ Storage::url('/images/icon/coursework-white.png') }}" />
            Create Coursework
        </a>
    @endif

    <!-- TODO: Add are you sure? message -->
    @if (\App\Utility\ModulePermission::canDelete($module))
        <a href="#" type="button" class="btn btn-danger page-title-button" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
            <img class="page-title-button-image" src="{{ Storage::url('/images/icon/trash-solid.png') }}" />
            Delete
        </a>
        <form id="delete-form" action="{{ route('module.delete', ['module_id' => $module->id]) }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endif
</div>