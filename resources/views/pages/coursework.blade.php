@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">
    <!-- Coursework Card -->
    @include('components.coursework.page.infobox', ['module'=>$coursework->module])
</div>

@endsection
<!-- End of the Section-->