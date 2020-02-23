@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
        <a href="{{ route('home') }}">Home</a>
    </div>

    <!-- Module Card -->
    @include('components.module.page.infobox', ['module'=>$module])

    <!-- Coursework Title Container -->
    @include('components.coursework.list.title', ['title'=>'Courseworks'])

    <!-- Bootstrap cards for the Modules courseworks -->
    @include('components.coursework.list.list', ['courseworks'=>$module->courseworks])
</div>

@endsection
<!-- End of the Section-->