@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- The form used to mark the coursework. Only contains an action if the user has permission to mark it -->
<form method="POST" @if ($isMarkable) action="{{ route('viewer.mark.save', ['module_id' => $coursework->module->id, 'coursework_id' => $coursework->id, 'submission_id' => $submission->id]) }}" @endif>

    <!-- Viewer menu bar -->
    <ul class="viewer-menu-bar nav nav-pills justify-content-end">
        <!-- Button to save Submission marking changes -->
        <li class="nav-item">
            <!-- TODO: button to update submission properties -->
            <a type="button" class="btn btn-primary" href="#">Save</a>
        </li>
        <!-- Name of the current module -->
        <li class="nav-item">
            <p class="nav-link disabled">Module: {{ $submission->coursework->module->name }}</p>
        </li>
        <!-- Name of the current coursework -->
        <li class="nav-item">
            <p class="nav-link disabled">Coursework: {{ $submission->coursework->name }}</p>
        </li>
        <!-- The current score given to this submission -->
        <li class="nav-item">
            @if ($submission->score != null)
                <p class="nav-link disabled">Score: {{ $submission->score }}</p>
            @else
                <p class="nav-link disabled">Score: N/A</p>
            @endif
        </li>
    </ul>

</form>

@endsection
<!-- End of the Section-->