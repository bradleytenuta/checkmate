@if ($errors->any())
    <div class="alert alert-danger mt-5" role="alert">
        @foreach ($errors->all() as $error)
            <p class="mb-0">{{ $error }}</p>
        @endforeach
    </div>
@endif