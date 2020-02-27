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
</div>