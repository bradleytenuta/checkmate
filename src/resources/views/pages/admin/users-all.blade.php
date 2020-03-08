@extends ('layouts.full')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Register Module form -->
<div class="checkmate-form">

    @csrf

    <!-- Title -->
    <h2>All Users</h2>

    <!-- All Users Table -->
    <div class="form-group row">
        @include('components.form.user-table')
    </div>
</div>

@endsection
<!-- End of the Section-->