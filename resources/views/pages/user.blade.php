@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<div class="checkmate-form">
    <!-- Title -->
    <h2>User Account</h2>

    <!-- First Name and Last Name row -->
    <div class="form-group row">
        <div class="col-md-6">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" value="{{ $user->firstname }}" disabled>
        </div>
        <div class="col-md-6">
            <label for="surname">Surname</label>
            <input type="text" class="form-control" value="{{ $user->surname }}" disabled>
        </div>
    </div>
</div>

@endsection
<!-- End of the Section-->