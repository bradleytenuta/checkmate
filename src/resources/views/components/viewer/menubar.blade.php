<ul class="viewer-menu-bar nav nav-pills">
    @if ($isMarkable && $submission != null)
        <!-- Button to save Submission marking changes -->
        <li class="nav-item">
            <button type="submit" class="btn btn-primary" href="#">Save</button>
        </li>
    @endif
    <!-- Name of the current module -->
    <li class="nav-item">
        <p class="nav-link disabled">Module: {{ $coursework->module->name }}</p>
    </li>
    <!-- Name of the current coursework -->
    <li class="nav-item">
        <p class="nav-link disabled">Coursework: {{ $coursework->name }}</p>
    </li>

    @if ($submission != null)
        <!-- The marker of the submission -->
        <li class="nav-item">
            @if ($submission->marker_id != null)
                @php $userMarker = $coursework->module->users->firstWhere('id', $submission->marker_id); @endphp
                <p class="nav-link disabled">Marker: {{ $userMarker->firstname }} {{ $userMarker->surname }}</p>
            @else
                <p class="nav-link disabled">Marker: N/A</p>
            @endif
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
    @endif
</ul>