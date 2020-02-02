@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">
    <!-- Module Title Container -->
    @include('components.list.title', ['title'=>'My Modules'])

    <!-- TODO: Add Javascript to filter and sort this list -->
    <!-- List of modules -->
    @include('components.list.modules', ['modules'=>$modules])
</div>

@endsection
<!-- End of the Section-->