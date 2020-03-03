@extends ('layouts.main')
<!-- TODO: remove footer -->
<!-- TODO: make page 100% height -->

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Includes Breadcrumb -->
@include('components.breadcrumb.submission-breadcrumb', ['coursework' => $submission->coursework])

<!-- The form used to mark the coursework. Only contains an action if the user has permission to mark it -->
<form method="POST" @if ($isMarkable) action="{{ route('viewer.mark.save', ['module_id' => $submission->coursework->module->id, 'coursework_id' => $submission->coursework->id, 'submission_id' => $submission->id]) }}" @endif>

    <!-- Viewer menu bar -->
    @include('components.viewer.menubar', ['submission' => $submission, 'isMarkable' => $isMarkable])

    <!-- Main container -->
    <div class="viewer-main-container">
        <!-- Left Side Container -->
        @include('components.viewer.left-container', ['submission' => $submission, 'files' => $files, 'isMarkable' => $isMarkable])

        <!-- Source code container -->
        @include('components.viewer.right-container', ['submission' => $submission, 'files' => $files, 'isMarkable' => $isMarkable])
    </div>

</form>

@endsection
<!-- End of the Section-->