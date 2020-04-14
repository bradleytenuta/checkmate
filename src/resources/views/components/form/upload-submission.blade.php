<form enctype="multipart/form-data" method="post" action="{{ route('submission.create', ['module_id' => $module->id, 'coursework_id' => $coursework->id]) }}">
    @csrf

    <div class="form-group row">
        <div class="col-sm-12">
            <input name="file" type="file"/>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <button type="submit" id="submit-button" class="btn btn-primary">Upload</button>
        </div>
    </div>
</form>