<div class="grid list-container">
    <!-- Used to set the size of the grids -->
    <div class="grid-sizer col-lg-2"></div>

    <!-- A list of all the cards -->
    @foreach ($courseworks as $coursework)
        <div class="grid-item col-lg-4 mb-2">
            <div class="card list-card-container">

                <!-- Coursework Card -->
                @include('components.card.coursework', ['coursework'=>$coursework])
            </div>
        </div>
    @endforeach
</div>