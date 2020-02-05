@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Register User form -->
<form method="POST" class="checkmate-form" action="{{ route('user.edit') }}">

    @csrf

    <!-- Title -->
    <h2>Edit Account</h2>

    <!-- Error messages if there are any -->
    @include('components.form.error')

    <!-- Email row -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" autofocus>
        </div>
    </div>

    <!-- First Name and Last Name row -->
    <div class="form-group row">
        <div class="col-md-6">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="firstname" id="firstname" value="{{ Auth::user()->firstname }}" autofocus>
        </div>
        <div class="col-md-6">
            <label for="surname">Surname</label>
            <input type="text" class="form-control" name="surname" id="surname" value="{{ Auth::user()->surname }}" autofocus>
        </div>
    </div>

    <!-- Password row -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="email">Password</label>
            <input type="password" class="form-control" name="password" id="password" autofocus>
        </div>
    </div>

    <!-- Edit Button -->
    <div class="form-group row">
      <div class="col-sm-12">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </form>

@endsection
<!-- End of the Section-->