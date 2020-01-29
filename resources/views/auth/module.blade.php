@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">

    <!-- Module Title Container -->
    @include('components.work.title', ['module'=>$module])

    <!-- Module Card -->
    @include('components.work.infobox', ['module'=>$module])

    <!-- Coursework Title Container -->
    @include('components.list.title', ['title'=>'Courseworks'])

    <!-- Bootstrap cards for the Modules courseworks -->
    <!-- TODO: Add Javascript to filter and sort this list -->
    @include('components.list.card', ['items'=>$module->courseworks, 'urlName'=>'coursework.show'])
</div>

@endsection
<!-- End of the Section-->