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
    @else
        <div class="page-title-badge card-closed badge badge-secondary">Closed</div>
    @endif

    <!-- Buttons -->
    @if (\App\Utility\ModulePermission::hasPermission(5, $module, Auth::user()) || Auth::user()->hasAdminRole())
        <a href="{{ route('coursework.edit.show', ['id' => $coursework->id]) }}" type="button" class="btn btn-primary page-title-button">
            Edit
        </a>
    @endif

    <!-- TODO: Add are you sure? message -->
    @if (\App\Utility\ModulePermission::hasPermission(6, $module, Auth::user()) || Auth::user()->hasAdminRole())
        <a href="#" type="button" class="btn btn-danger page-title-button" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
            <img class="page-title-button-image" src="{{ Storage::url('/images/icon/trash-solid.png') }}" />
            Delete
        </a>
        <form id="delete-form" action="{{ route('coursework.delete', ['id' => $coursework->id]) }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endif

    <!-- Shows deadline -->
    @if ( \App\Utility\Time::dateIsToday($coursework) )
        <p class="page-title-text card-due-today card-info-element">{{ $coursework->deadline }}</p>
    @elseif ( \App\Utility\Time::dateHasPassed($coursework) )
        <p class="page-title-text card-due-passed card-info-element">{{ $coursework->deadline }}</p>
    @else
        <p>{{ $coursework->deadline }}</p>
    @endif
</div>