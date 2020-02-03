<div class="card-body">

    <!-- Card Title -->
    <h5>{{ $coursework->name }}</h5>

    <!-- Card info icons -->
    <div class="card-info-container">

        <!-- Icon to show if the coursework is open or closed -->
        @if ($coursework->open == true)
            <div class="card-info-element card-open badge badge-secondary">Open</div>
        @else
            <div class="card-info-element card-closed badge badge-secondary">Closed</div>
        @endif

        <!-- Shows deadline -->
        @if ( \App\Utility\Time::dateIsToday($coursework) )
            <p class="card-due-today card-info-element">{{ $coursework->deadline }}</p>
        @elseif ( \App\Utility\Time::dateHasPassed($coursework) )
            <p class="card-due-passed card-info-element">{{ $coursework->deadline }}</p>
        @else
            <p>{{ $coursework->deadline }}</p>
        @endif
    </div>

    <!-- Card Description -->
    <p class="card-text">{{ $coursework->description }}</p>

    <!-- Links to open coursework -->
    <a href="{{ route('coursework.show', ['id' => $coursework->id]) }}" class="card-link">Open</a>
</div>