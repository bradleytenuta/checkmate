@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Register User form -->
<form method="POST" class="checkmate-form" action="{{ route('user.edit', ['user_id' => $user->id]) }}">

    @csrf

    <!-- Title -->
    <h2>Edit Account</h2>

    <!-- Error messages if there are any -->
    @include('components.form.error')

    <!-- Email row -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" autofocus>
        </div>
    </div>

    <!-- First Name and Last Name row -->
    <div class="form-group row">
        <div class="col-md-6">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="firstname" id="firstname" value="{{ $user->firstname }}" autofocus>
        </div>
        <div class="col-md-6">
            <label for="surname">Surname</label>
            <input type="text" class="form-control" name="surname" id="surname" value="{{ $user->surname }}" autofocus>
        </div>
    </div>

    <!-- Checkbox on whether or not to give the user admin rights -->
    <div class="form-group row">
        <div class="col-sm-12">
            <div class="form-check">
                @if ($user->hasAdminRole())
                    <input class="form-check-input" type="checkbox" name="admin" id="admin" autofocus checked>
                @else
                    <input class="form-check-input" type="checkbox" name="admin" id="admin" autofocus>
                @endif
                <label class="form-check-label" for="admin">Admin Privileges</label>
            </div>
        </div>
    </div>

    <!-- Password row -->
    <!-- TODO: Make this harder to change, ask for old password and new password twice -->
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="email">Password</label>
            <input type="password" class="form-control" name="password" id="password" autofocus>
        </div>
    </div>

    <!-- Save Button -->
    <div class="form-group row">
         <div class="col-sm-12">
            <button type="submit" class="btn btn-primary">Save</button>

            <!-- TODO: Add an are you sure? message -->
            <a href="#" type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Delete</a>
        </div>
    </div>
</form>

<!-- Form to delete current user -->
<form id="delete-form" action="{{ route('user.delete', ['user_id' => $user->id]) }}" method="POST" style="display: none;">
    @csrf
</form>

@endsection
<!-- End of the Section-->