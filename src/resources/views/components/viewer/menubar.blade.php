<ul class="viewer-menu-bar nav nav-pills">
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
    <!-- The Unit Test results -->
    <!-- TODO: Display Unit test results -->
    <li class="nav-item">
        <p class="nav-link disabled">Tests: N/A</p>
    </li>
</ul>