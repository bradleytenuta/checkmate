@extends ('layouts.full')

<!-- JS section -->
@section ('dynamic-js')
    <script src="{{ URL::asset('js/components/form.js') }}" defer></script>
@endsection
<!-- End of JS section -->

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Register User form -->
<form method="POST" class="checkmate-form" action="{{ route('coursework.create', ['module_id' => $module->id]) }}">

    @csrf

    <!-- Title -->
    <h2>Create Coursework</h2>

    <!-- Error messages if there are any -->
    @include('components.form.error')

    <!-- Include Module ID so we know which module to add the coursework to. This is hidden from the user -->
    <input type="text" readonly="readonly" class="form-control" name="module_id" id="module_id" value="{{ $module->id }}" style="display: none;">

    <!-- Module name box -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="name">Name<span class="field-required">*</span></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" required autofocus>
        </div>
    </div>

    <!-- Description text box -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="description">Description<span class="field-required">*</span></label>
            <textarea class="form-control" rows="6" name="description" id="description" placeholder="Description" required autofocus></textarea>
        </div>
    </div>

    <!-- Max Score text box -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="maximum_score">Max Score<span class="field-required">*</span></label>
            <input type="text" class="form-control" name="maximum_score" id="maximum_score" placeholder="100">
        </div>
    </div>

    <!-- Coursework Type box -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="coursework_type_id">Coursework Type<span class="field-required">*</span></label>
            <select class="form-control" id="type" name="coursework_type_id">
                @foreach (DB::table('coursework_types')->get() as $courseworkType)
                    <option value="{{ $courseworkType->id }}">
                        {{ $courseworkType->name }}
                    </option>
                @endforeach
              </select>
        </div>
    </div>

    <!-- Start Date text box -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="start_date">Start Date<span class="field-required">*</span></label>
            <input type="text" class="form-control" name="start_date" id="start_date" placeholder="Start Date">
        </div>
    </div>

    <!-- Deadline text box -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="deadline">Deadline<span class="field-required">*</span></label>
            <input type="text" class="form-control" name="deadline" id="deadline" placeholder="Deadline">
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