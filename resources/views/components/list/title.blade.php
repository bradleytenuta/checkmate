<!-- A title container component used before the list component -->
<div class="list-title-container container-fluid">
    <div class="row">
        <div class="col-md-12">

            <!-- Title -->
            <h1>{{ $title ?? '' }}</h1>

            <!-- Filter Buttons -->
            <div id="list-filter-container" class="list-title-button-group btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                    <input type="radio" id="list-filter-all" autocomplete="off" onclick="toggleListFilter(this, 0)">
                    All
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" id="list-filter-open" autocomplete="off" onclick="toggleListFilter(this, 1)">
                    Open
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" id="list-filter-closed" autocomplete="off" onclick="toggleListFilter(this, 2)">
                    Closed
                </label>
            </div>
        </div>
    </div>
</div>