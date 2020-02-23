@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
        <a href="{{ route('home') }}">Home</a>
        >
        <a href="{{ route('module.show', ['module_id' => $coursework->module->id]) }}">{{ $coursework->module->name }}</a>
    </div>

    <!-- Coursework Card -->
    @include('components.coursework.page.infobox', ['module' => $coursework->module])

    <!-- Submission Container -->
    <div id="submission-container">
        <h1>Submission</h1>
        <div class="checkmate-form">
            <!-- Error messages if there are any -->
            @include('components.form.error')

            <!-- Student view -->
            @if (\App\Utility\ModulePermission::hasRole($coursework->module, Auth::user(), 'student') && $coursework->open == true)
                <!-- If the user has already submitted before, then show submission -->
                @include('components.form.current-submission', ['coursework' => $coursework])

                <!-- Form for if the user is a student in coursework -->
                @include('components.form.upload-submission', ['module' => $coursework->module, 'coursework' => $coursework])
            @endif
        </div>
    </div>
</div>

@endsection
<!-- End of the Section-->