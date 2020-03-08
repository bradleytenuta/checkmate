@extends ('layouts.full')

<!-- JS section -->
@section ('dynamic-js')
    <script src="{{ URL::asset('js/components/list.js') }}" defer></script>
@endsection
<!-- End of JS section -->

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">
    <!-- Module Title Container -->
    @include('components.module.list.title', ['title'=>'My Modules'])

    <!-- List of modules -->
    @include('components.module.list.list', ['modules'=>$modules])
</div>

@endsection
<!-- End of the Section-->