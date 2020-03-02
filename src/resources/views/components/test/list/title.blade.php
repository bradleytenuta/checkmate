<!-- A title container component used before the list component -->
<div class="list-title-container container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Title -->
            <h1>{{ $title ?? '' }}</h1>

            <!-- Add Test button -->
            @if ($coursework->open)
                <div id="list-filter-container" class="list-title-button-group" data-toggle="buttons">
                    <a href="{{ route('test.create.show', ['module_id' => $coursework->module->id, 'coursework_id' => $coursework->id]) }}" type="button" class="btn btn-primary button-with-image">
                        <img src="{{ Storage::url('/images/icon/add-unit-test.png') }}" />
                        Add Unit Test
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>