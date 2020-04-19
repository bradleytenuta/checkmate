<!-- A title container component used before the list component -->
<div class="list-title-container container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Title -->
            <h1>{{ $title ?? '' }}</h1>

            @if (\App\Utility\CourseworkPermission::canMark($coursework->module))
                <!-- Add Moss button -->
                <div id="list-filter-container" class="list-title-button-group" data-toggle="buttons">
                    <a
                        href="{{ route('coursework.moss', ['module_id' => $coursework->module->id, 'coursework_id' => $coursework->id]) }}"
                        type="button" class="btn btn-primary button-with-image">
                        Run Moss (manually)
                    </a>
                </div>

                <!-- Add Test button -->
                <div id="list-filter-container" class="list-title-button-group" data-toggle="buttons">
                    <a
                        href="{{ route('coursework.test', ['module_id' => $coursework->module->id, 'coursework_id' => $coursework->id]) }}"
                        type="button" class="btn btn-primary button-with-image">
                        Run Tests (manually)
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>