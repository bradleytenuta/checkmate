<form enctype="multipart/form-data" method="post" action="{{ route('submission.create', ['module_id' => $module->id, 'coursework_id' => $coursework->id]) }}">
    @csrf

    <!-- Include Coursework ID so we know which coursework the submission belongs to. This is hidden from the user -->
    <input type="text" readonly="readonly" class="form-control" name="coursework_id" id="coursework_id" value="{{ $coursework->id }}" style="display: none;">

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