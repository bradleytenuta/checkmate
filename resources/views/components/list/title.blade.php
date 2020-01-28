<!-- A title container component used before the list component -->
<div class="list-title-container container-fluid">
    <div class="row">
        <!-- Title -->
        <div class="col-md-6">
            <h1>{{ $title ?? '' }}</h1>
        </div>
        <!-- Filter Buttons -->
        <div class="col-md-6">
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