@extends ('layouts.full')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Register Module form -->
<form method="POST" class="checkmate-form" action="{{ route('module.edit') }}">

    @csrf

    <!-- Title -->
    <h2>Edit Module</h2>

    <!-- Error messages if there are any -->
    @include('components.form.error')

    <!-- Include Module ID so we know which module to update. This is hidden from the user -->
    <input type="text" class="form-control" name="id" id="id" value="{{ $module->id }}" style="display: none;">

    <!-- Module name box -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $module->name }}" autofocus>
        </div>
    </div>

    <!-- Description text box -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="description">Description</label>
            <textarea class="form-control" rows="6" name="description" id="description" autofocus>{{ $module->description }}</textarea>
        </div>
    </div>

    <!-- Assign Users Table -->
    <div class="form-group row">
        @include('components.form.assign-table-edit', ['module'=>$module])
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