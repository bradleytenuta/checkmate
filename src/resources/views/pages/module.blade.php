@extends ('layouts.full')

<!-- JS section -->
@section ('dynamic-js')
    <script src="{{ URL::asset('js/components/list.js') }}" defer></script>
    <script src="{{ URL::asset('js/components/page.js') }}" defer></script>
@endsection
<!-- End of JS section -->

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">
    <!-- Top Menu -->
    @include('components.module.top-menu', ['module'=>$module])

    <!-- Module Card -->
    @include('components.module.page.infobox', ['module'=>$module])

    <!-- Coursework Title Container -->
    @include('components.coursework.list.title', ['title'=>'Courseworks'])

    <!-- Bootstrap cards for the Modules courseworks -->
    @include('components.coursework.list.list', ['courseworks'=>$module->courseworks])
</div>

@endsection
<!-- End of the Section-->