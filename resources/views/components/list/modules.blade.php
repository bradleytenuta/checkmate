<div class="grid list-container">
    <!-- Used to set the size of the grids -->
    <div class="grid-sizer col-lg-2"></div>

    <!-- A list of all the cards -->
    @foreach ($modules as $module)
        <div class="grid-item col-lg-4 mb-2">
            <div class="card list-card-container">

                <!-- Module Card -->
                @include('components.card.module', ['module'=>$module])

                <!-- See Coursework button -->
                <button type="button" class="checkmate-button" onclick="toggleCourseworkDropdown(this)">
                    <img src="{{ Storage::url('/images/icon/angle-down-solid.png') }}"/>
                </button>

                <!-- All courseworks container -->
                <div class="list-module-coursework-container">
                    @foreach ($module->courseworks as $coursework)
                        <!-- Coursework Card -->
                        @include('components.card.coursework', ['coursework'=>$coursework])
                    @endforeach
                </div>

            </div>
        </div>
    @endforeach
</div>