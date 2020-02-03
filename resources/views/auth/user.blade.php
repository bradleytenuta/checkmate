@extends ('layouts.main')
<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">
    <!-- User Card -->
    @include('components.user.page.infobox', ['user'=>$user])
</div>

@endsection
<!-- End of the Section-->