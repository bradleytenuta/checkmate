@extends ('layouts.main')
<!-- TODO: reformat this file and the register use file -->

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Register User form -->
<form method="POST" class="checkmate-form">

    @csrf

    <!-- Title -->
    <h2>Create Module</h2>

    <!-- Module name box -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="name">{{ __('Name') }}</label>
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
            <label for="description">{{ __('Description') }}</label>
            <textarea class="form-control" rows="6" name="description" id="description" placeholder="Description" required autofocus></textarea>
        </div>
    </div>

    <!-- TODO: Finish -->
    <!-- All Selections container -->
    <div class="form-group row">
            
        <!-- Select Professors -->
        <div class="col-sm-4">
        </div>

        <!-- Select assessors -->
        <div class="col-sm-4">
        </div>

        <!-- Select students -->
        <div class="col-sm-4">
        </div>
    </div>

    <!-- Register Button -->
    <div class="form-group row">
      <div class="col-sm-12">
        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
      </div>
    </div>
  </form>

@endsection
<!-- End of the Section-->