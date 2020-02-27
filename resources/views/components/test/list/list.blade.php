<div class="grid list-container">
    <!-- Used to set the size of the grids -->
    <div class="grid-sizer col-lg-2"></div>

    <!-- A list of all the cards -->
    @foreach ($tests as $test)
        <div class="grid-item col-lg-4 mb-2">
            <div class="card list-card-container">
                <!-- Test Card -->
                @include('components.test.card', ['test' => $test])
            </div>
        </div>
    @endforeach
</div>

<!-- Display empty message if no cards shown -->
@include('components.alert.empty-card', ['cards' => $tests, 'name' => 'Tests'])