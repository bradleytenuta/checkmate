@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Register User form -->
<form method="POST" class="checkmate-form" action="{{ route('module.create') }}">

    @csrf

    <!-- Title -->
    <h2>Create Module</h2>

    <!-- Error messages if there are any -->
    @include('components.form.error')

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

    <!-- Assign Users Table -->
    <div class="form-group row">
        @include('components.form.assign-table')
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