@extends ('layouts.full')

<!-- JS section -->
@section ('dynamic-js')
    <script src="{{ URL::asset('js/components/form.js') }}" defer></script>
@endsection
<!-- End of JS section -->

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Register User form -->
<form enctype="multipart/form-data" method="POST" class="checkmate-form" action="{{ route('test.create', ['module_id' => $module->id, 'coursework_id' => $coursework->id]) }}">
    @csrf

    <!-- Title -->
    <h2>Create Test</h2>

    <!-- Error messages if there are any -->
    @include('components.form.error')

    <!-- Option on whether the test is public or private -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="name">Test Type<span class="field-required">*</span></label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="test_type" value="true" checked>
                <label class="form-check-label">Public</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="test_type" value="false">
                <label class="form-check-label">Private</label>
            </div>
        </div>
    </div>

    <!-- Input field to upload file -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="description">Upload Test<span class="field-required">*</span></label>
        </div>
        <div class="col-sm-12">
            <input name="file" type="file"/>
        </div>
    </div>

    <!-- Info box for creating a test -->
    <div class="form-group row alert alert-primary" role="alert">
        <div class="col-sm-12">
            <p class="mb-0">File should be of type: '.zip'</p>
        </div>
    </div>

    <!-- Register Button -->
    <div class="form-group row">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </div>
  </form>

@endsection
<!-- End of the Section-->