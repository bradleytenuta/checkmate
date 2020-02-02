<div class="card-body">

    <!-- Card Title -->
    <h5>{{ $coursework->name }}</h5>

    <!-- Card info icons -->
    <div class="list-card-info-container">

        <!-- Icon to show if the coursework is open or closed -->
        @if ($coursework->open == true)
            <div class="list-card-info-element list-card-open badge badge-secondary">Open</div>
        @else
            <div class="list-card-info-element list-card-closed badge badge-secondary">Closed</div>
        @endif

        <!-- Shows deadline -->
        @if(Auth::user()->dateIsToday($coursework))
            <p class="list-card-due-today list-card-info-element">Due Today!</p>
        @else
            <p>{{ $coursework->deadline }}</p>
        @endif
    </div>

    <!-- Card Description -->
    <p class="card-text">{{ $coursework->description }}</p>

    <!-- Links to open coursework -->
    <a href="{{ route('coursework.show', ['id' => $coursework->id]) }}" class="card-link">Open</a>
</div>