@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">
    <!-- Top Menu -->
    @include('components.coursework.top-menu', ['module' => $coursework->module, 'coursework' => $coursework])

    <!-- Coursework Card -->
    @include('components.coursework.page.infobox', ['module' => $coursework->module])

    <!-- Assessor and Professor View -->
    <!-- TODO: Change so public tests are displayed for students -->
    @if (\App\Utility\CourseworkPermission::canMark($coursework->module))
        <!-- All Tests Cards -->
        @include('components.test.list.title', ['title'=>'Unit Tests'])
        <!-- List of tests -->
        @include('components.test.list.list', ['tests'=>$coursework->tests])
    @endif

    <!-- Submission Container -->
    <div id="submission-container">
        <h1>Submission</h1>
        <div class="checkmate-submission-form">
            <!-- Error messages if there are any -->
            @include('components.form.error')

            <!-- Student view -->
            @if (\App\Utility\ModulePermission::hasRole($coursework->module, Auth::user(), 'student'))
                <!-- If the user has already submitted before, then show submission -->
                @include('components.form.current-submission', ['coursework' => $coursework])

                <!-- Form for if the user is a student in coursework, and the coursework is still open -->
                @if ($coursework->open == true)
                    @include('components.form.upload-submission', ['module' => $coursework->module, 'coursework' => $coursework])
                @endif
            @endif

            <!-- Assessor and Professor View -->
            @if (\App\Utility\CourseworkPermission::canMark($coursework->module))
                <!-- All Submissions table -->
                @include('components.submission.submission-table', ['coursework' => $coursework])
            @endif
        </div>
    </div>
</div>

@endsection
<!-- End of the Section-->