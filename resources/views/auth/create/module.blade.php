@extends ('layouts.main')
<!-- TODO: reformat this file and the register use file -->

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Register User form -->
<form method="POST" class="checkmate-form" action="{{ route('create.module') }}">

    @csrf

    <!-- Title -->
    <h2>Create Module</h2>

    <!-- Module name box -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="name">Name<span class="field-required">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" required autofocus>
            @error('name')
            <div class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
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
        @include('components.table.module-assign')
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