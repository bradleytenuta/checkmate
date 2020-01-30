<!-- A title container component used before the list component -->
<div class="list-title-container container-fluid">
    <div class="row">
        <div class="col-md-12">

            <!-- Title -->
            <h1>{{ $title ?? '' }}</h1>

            <!-- Filter Buttons -->
            <div class="list-title-button-group btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                    <input type="radio" name="options" id="option1" autocomplete="off" checked>{{ __('All') }}
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="options" id="option2" autocomplete="off">{{ __('Open') }}
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="options" id="option3" autocomplete="off">{{ __('Closed') }}
                </label>
            </div>
        </div>
    </div>
</div>