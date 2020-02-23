<!-- Coursework title -->
<div class="col-md-6">
    <h1>{{ $coursework->name }}</h1>
</div>

<!-- Coursework Admin buttons -->
<div class="col-md-6">

    <!-- Icon -->
    <img 
        class="page-title-icon"
        src="{{ Storage::url(\App\Utility\ModulePermission::permissionIconPath($module, Auth::user())) }}"
        data-toggle="tooltip"
        data-placement="bottom"
        title="{{ \App\Utility\ModulePermission::permissionText($module, Auth::user()) }}">

    <!-- Icon to show if the coursework is open or closed -->
    @if ($coursework->open == true)
        <div class="page-title-badge card-open badge badge-secondary">Open</div>
    @elseif (\App\Utility\Time::dateInFuture($coursework))
        <div class="page-title-badge card-pending badge badge-secondary">Pending</div>
    @else
        <div class="page-title-badge card-closed badge badge-secondary">Closed</div>
    @endif

    <!-- Buttons -->
    @if (\App\Utility\CourseworkPermission::canEdit($module))
        <a href="{{ route('coursework.edit.show', ['module_id' => $module->id, 'coursework_id' => $coursework->id]) }}" type="button" class="btn btn-primary page-title-button">
            Edit
        </a>
    @endif

    @if (\App\Utility\CourseworkPermission::canEdit($module))
        <!-- TODO: add functionality -->
        <a href="#" type="button" class="btn btn-primary page-title-button">
            <img class="page-title-button-image" src="{{ Storage::url('/images/icon/unit-test.png') }}" />
            Unit Tests
        </a>
    @endif

    <!-- TODO: Add are you sure? message -->
    @if (\App\Utility\CourseworkPermission::canDelete($module))
        <a href="#" type="button" class="btn btn-danger page-title-button" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
            <img class="page-title-button-image" src="{{ Storage::url('/images/icon/trash-solid.png') }}" />
            Delete
        </a>
        <form id="delete-form" action="{{ route('coursework.delete', ['module_id' => $module->id, 'coursework_id' => $coursework->id]) }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endif

    <!-- Shows deadline -->
    @if ( \App\Utility\Time::dateIsToday($coursework) )
        <p class="page-title-text card-due-today card-info-element">{{ $coursework->start_date }} - {{ $coursework->deadline }}</p>
    @elseif ( \App\Utility\Time::dateHasPassed($coursework) )
        <p class="page-title-text card-due-passed card-info-element">{{ $coursework->start_date }} - {{ $coursework->deadline }}</p>
    @else
        <p class="page-title-text card-info-element">{{ $coursework->start_date }} - {{ $coursework->deadline }}</p>
    @endif
</div>