<div class="card-body">

    <!-- Card Title -->
    <h5>{{ $coursework->name }}</h5>

    <!-- Card info icons -->
    <div class="list-card-info-container">

        <!-- Icon to show if the coursework is open or closed -->
        @if ($coursework->open == true)
            <img 
                class="list-card-info-element"
                src="{{ Storage::url('/images/other/item-open.png') }}"
                data-toggle="tooltip"
                data-placement="bottom"
                title="Open" />
        @else
            <img 
                class="list-card-info-element"
                src="{{ Storage::url('/images/other/item-closed.png') }}"
                data-toggle="tooltip"
                data-placement="bottom"
                title="Closed" />
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