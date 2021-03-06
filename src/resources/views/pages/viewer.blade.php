@extends ('layouts.navbar-only')

<!-- CSS section -->
@section ('dynamic-css')
    <link href="{{ URL::asset('css/pages/viewer.css') }}" rel="stylesheet">
    <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/styles/default.min.css">
@endsection
<!-- End of CSS section -->

<!-- JS section -->
@section ('dynamic-js')
    <script src="{{ URL::asset('js/pages/viewer.js') }}" defer></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endsection
<!-- End of JS section -->

<!-- Begining of the Section-->
@section ('dynamic-main-content')

    <!-- Includes Breadcrumb -->
    @include('components.breadcrumb.submission-breadcrumb', ['coursework' => $coursework])

    <!-- The form used to mark the coursework. Only contains an action if the user has permission to mark it -->
    <form method="POST" id="viewer-form" @if ($isMarkable && $submission != null) action="{{ route('viewer.mark.save', ['module_id' => $coursework->module->id, 'coursework_id' => $coursework->id, 'submission_id' => $submission->id]) }}" @endif>
        @csrf

        <!-- Viewer menu bar -->
        @include('components.viewer.menubar', ['submission' => $submission, 'coursework' => $coursework, 'isMarkable' => $isMarkable])

        <!-- Main container -->
        <div class="viewer-main-container">
            <!-- Left Side Container -->
            @include('components.viewer.left-container', ['submission' => $submission, 'files' => $files, 'isMarkable' => $isMarkable])

            <!-- Source code container -->
            @include('components.viewer.right-container', ['files' => $files, 'isMarkable' => $isMarkable])
        </div>
    </form>

@endsection
<!-- End of the Section-->