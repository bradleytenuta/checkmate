@extends ('layouts.full')

<!-- JS section -->
@section ('dynamic-js')
    <script src="{{ URL::asset('js/components/form.js') }}" defer></script>
@endsection
<!-- End of JS section -->

<!-- Begining of the Section-->
@section ('dynamic-main-content')

    <!-- Register Coursework form -->
    <form method="POST" class="checkmate-form" action="{{ route('coursework.edit', ['module_id' => $coursework->module->id]) }}">

        @csrf

        <!-- Title -->
        <h2>Edit Coursework</h2>

        <!-- Error messages if there are any -->
        @include('components.form.error')

        <!-- Include Coursework ID so we know which coursework to update. This is hidden from the user -->
        <input type="text" class="form-control" name="id" id="id" value="{{ $coursework->id }}" style="display: none;">

        <!-- Coursework name box -->
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $coursework->name }}" autofocus>
            </div>
        </div>

        <!-- Description text box -->
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="description">Description</label>
                <textarea class="form-control" rows="6" name="description" id="description" autofocus>{{ $coursework->description }}</textarea>
            </div>
        </div>

        <!-- Max Score text box -->
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="maximum_score">Max Score</label>
                <input type="text" class="form-control" name="maximum_score" id="maximum_score" value="{{ $coursework->maximum_score }}">
            </div>
        </div>

        <!-- Coursework Type box -->
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="coursework_type_id">Coursework Type</label>
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
                <label for="start_date">Start Date</label>
                <input type="text" class="form-control" name="start_date" id="start_date" placeholder="Start Date">
            </div>
        </div>

        <!-- Deadline text box -->
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="deadline">Deadline</label>
                <input type="text" class="form-control" name="deadline" id="deadline" value="{{ $coursework->deadline }}">
            </div>
        </div>

        <!-- Save Button -->
        <div class="form-group row">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </div>
    </form>

@endsection
<!-- End of the Section-->