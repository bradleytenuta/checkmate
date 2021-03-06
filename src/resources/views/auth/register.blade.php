@extends ('layouts.full')

<!-- JS section -->
@section ('dynamic-js')
    <script src="{{ URL::asset('js/components/form.js') }}" defer></script>
@endsection
<!-- End of JS section -->

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Register User form -->
<form method="POST" class="checkmate-form" action="{{ route('register') }}">

    @csrf

    <!-- Title -->
    <h2>Register User</h2>

    <!-- Email row -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="email">Email<span class="field-required">*</span></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" required autofocus>
            @error('email')
            <div class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <!-- First Name and Last Name row -->
    <div class="form-group row">
        <div class="col-md-6">
            <label for="firstname">First Name<span class="field-required">*</span></label>
            <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" id="firstname" placeholder="First name" required autofocus>
        
            @error('firstname')
            <div class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="surname">Surname<span class="field-required">*</span></label>
            <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" id="surname" placeholder="Surname" required autofocus>
            @error('surname')
            <div class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    
    <!-- Checkbox on whether or not to give the user admin rights -->
    <div class="form-group row">
      <div class="col-sm-12">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="admin" id="admin" autofocus>
          <label class="form-check-label" for="admin">Admin Privileges</label>
        </div>
      </div>
    </div>

    <!-- Register Button -->
    <div class="form-group row">
      <div class="col-sm-12">
        <button type="submit" class="btn btn-primary">Register</button>
      </div>
    </div>

    <!-- An information box for the use who is creating another user. -->
    <div class="alert alert-primary mt-5" role="alert">
        <p>The password for a new user is automatically generated.</p>
        <hr>
        <p class="mb-0">The user will have to login themselves and update their password to whatever they like.</p>
    </div>
  </form>

@endsection
<!-- End of the Section-->