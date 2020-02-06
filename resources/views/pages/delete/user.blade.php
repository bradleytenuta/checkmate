@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Register Module form -->
<form method="POST" class="checkmate-form" action="{{ route('user.delete') }}">

    @csrf

    <!-- Title -->
    <h2>Delete User</h2>

    <!-- Error messages if there are any -->
    @include('components.form.error')

    <!-- Delete Users Table -->
    <div class="form-group row">
        @include('components.form.delete-table')
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