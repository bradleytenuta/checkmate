<div class="card-body">

    <!-- Card Title -->
    <h5>{{ $coursework->name }}</h5>

    <!-- Card info icons -->
    <div class="card-info-container">

        <!-- Icon to show if the coursework is open or closed -->
        @if ($coursework->open == true)
            <div class="card-info-element card-open badge badge-secondary">Open</div>
        @elseif (\App\Utility\Time::dateInFuture($coursework))
            <div class="card-info-element card-pending badge badge-secondary">Pending</div>
        @else
            <div class="card-info-element card-closed badge badge-secondary">Closed</div>
        @endif

        <!-- Shows coursework type -->
        <img 
            class="card-info-element"
            src="{{ Storage::url(\App\Utility\CourseworkType::getIconPath($coursework->coursework_type_id)) }}"
            data-toggle="tooltip"
            data-placement="bottom"
            title="{{ \App\Utility\CourseworkType::getName($coursework->coursework_type_id) }}" />

        <!-- Shows deadline -->
        @if (\App\Utility\Time::dateIsToday($coursework))
            <p class="card-due-today card-info-element">{{ $coursework->start_date }} - {{ $coursework->deadline }}</p>
        @elseif (\App\Utility\Time::dateHasPassed($coursework))
            <p class="card-due-passed card-info-element">{{ $coursework->start_date }} - {{ $coursework->deadline }}</p>
        @else
            <p>{{ $coursework->start_date }} - {{ $coursework->deadline }}</p>
        @endif
    </div>

    <!-- Card Description -->
    <p class="card-text">{{ $coursework->description }}</p>

    <!-- Links to open coursework -->
    @if (\App\Utility\CourseworkPermission::canShow($coursework))
        <a href="{{ route('coursework.show', ['module_id' => $module->id, 'coursework_id' => $coursework->id]) }}" class="card-link">Open</a>
    @else
        <a class="card-link" style="opacity: 50%;">Open</a>
    @endif

    <!-- If the user has the option to edit the module, then they have the option to edit the coursework -->
    @if (\App\Utility\CourseworkPermission::canEdit($module))
        <a href="{{ route('coursework.edit.show', ['module_id' => $module->id, 'coursework_id' => $coursework->id]) }}" class="card-link">Edit</a>
    @endif
</div>