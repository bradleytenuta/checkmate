@extends ('layouts.full')

<!-- JS section -->
@section ('dynamic-js')
    <script src="{{ URL::asset('js/components/form.js') }}" defer></script>
@endsection
<!-- End of JS section -->

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

        <!-- Password first row -->
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="password_typed_first">New Password</label>
                <input type="password" class="form-control" name="password_typed_first" id="password_typed_first" autofocus>
            </div>
        </div>

        <!-- Password row -->
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="password">Type New Password Again</label>
                <input type="password" class="form-control" name="password" id="password" autofocus>
            </div>
        </div>

        <!-- Save Button -->
        <div class="form-group row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Save</button>

                <!-- Delete Button -->
                <a href="#" type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmation-modal">Delete</a>
            </div>
        </div>
    </form>

    <!-- Modal -->
    @include('components.form.confirmation-modal', ['route'=> route('user.delete', ['user_id' => $user->id])])

@endsection
<!-- End of the Section-->