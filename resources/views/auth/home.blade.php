@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">

    <!-- Module Title Container -->
    @include('components.list.title', ['title'=>'My Modules'])

    <!-- TODO: Add Javascript to filter and sort this list -->
    <!-- List of modules -->
    @include('components.list.card', ['items'=>$modules, 'urlName'=>'module.show'])

    <!-- TODO: Add section to show courseworks in deadline order -->
    <!-- Coursework Title Container -->
    @include('components.list.title', ['title'=>'My Courseworks'])

    <!-- List of courseworks -->
    <!-- TODO: Make 2 cards, one for modules and 1 for courseworks. -->
    @include('components.list.card', ['items'=>$courseworks, 'urlName'=>'coursework.show'])

</div>

@endsection
<!-- End of the Section-->