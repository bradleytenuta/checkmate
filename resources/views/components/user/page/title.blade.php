<!-- Module title -->
<div class="col-md-6">
    <h1>{{ $user->firstname }} {{ $user->surname }}</h1>
</div>

<!-- Admin buttons -->
<div class="col-md-6">

    <!-- If the user is the current user -->
    @if ($user->id == Auth::user()->id)
        <a href="#" type="button" class="btn btn-primary page-title-button">Edit</a>
    @endif
</div>