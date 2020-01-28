@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">

    <!-- Module Title Container -->
    @include('components.list.title', ['title'=>'My Modules'])

    <!-- Bootstrap cards for the Users Modules -->
    <!-- TODO: Add Javascript to filter and sort this list -->
    @foreach (Auth::user()->modules as $module)
        @include('components.list.card', ['item'=>$module, 'urlName'=>'module.show'])
    @endforeach

    <!-- TODO: Add section to show courseworks in deadline order -->
    @include('components.list.title', ['title'=>'My Courseworks'])
    @foreach (Auth::user()->modules as $module)
        @foreach ($module->courseworks as $coursework)
            @include('components.list.card', ['item'=>$coursework, 'urlName'=>'coursework.show'])
        @endforeach
    @endforeach

</div>

@endsection
<!-- End of the Section-->