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

    <!-- Shows coursework type -->
    <img 
        class="page-title-icon"
        src="{{ Storage::url(\App\Utility\CourseworkType::getIconPath($coursework->coursework_type_id)) }}"
        data-toggle="tooltip"
        data-placement="bottom"
        title="{{ \App\Utility\CourseworkType::getName($coursework->coursework_type_id) }}" />

    <!-- Icon to show if the coursework is open or closed -->
    @if ($coursework->open == true)
        <div class="page-title-badge card-open badge badge-secondary">Open</div>
    @elseif (\App\Utility\Time::dateInFuture($coursework))
        <div class="page-title-badge card-pending badge badge-secondary">Pending</div>
    @else
        <div class="page-title-badge card-closed badge badge-secondary">Closed</div>
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