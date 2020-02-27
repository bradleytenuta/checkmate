@if ($cards->count() == 0)
    <div class="checkmate-form">
        <div class="form-group row alert alert-primary" role="alert">
            <div class="col-sm-12">
                <h4 class="no-margin text-centre">No {{ $name }} Found</h4>
            </div>
        </div>
    </div>
@endif