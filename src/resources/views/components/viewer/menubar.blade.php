<ul class="viewer-menu-bar nav nav-pills">
    @if ($isMarkable && $submission != null)
        <!-- Button to save Submission marking changes -->
        <li class="nav-item">
            <button type="submit" class="btn btn-primary" href="#">Save</button>
        </li>
    @endif
    <!-- Name of the current module -->
    <li class="nav-item">
        <a href="{{ route('module.show', ['module_id' => $coursework->module->id]) }}"
            class="nav-link">Module: {{ $coursework->module->name }}</a>
    </li>
    <!-- Name of the current coursework -->
    <li class="nav-item">
        <a href="{{ route('coursework.show', ['module_id' => $coursework->module->id, 'coursework_id' => $coursework->id]) }}"
            class="nav-link">Coursework: {{ $coursework->name }}</a>
    </li>

    @if ($submission != null)
        @php
            $submission_json_obj = json_decode($submission->json);
        @endphp

        <!-- The marker of the submission -->
        <li class="nav-item">
            @if ($submission->marker_id != null)
                @php $userMarker = $coursework->module->users->firstWhere('id', $submission->marker_id); @endphp
                <a href="{{ route('user.show', ['user_id' => $userMarker->id]) }}"
                    class="nav-link">Marker: {{ $userMarker->firstname }} {{ $userMarker->surname }}</a>
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
        <li class="nav-item">
            @if (!empty($submission_json_obj->test_results))
                @foreach ($submission_json_obj->test_results as $value)
                    <p class="nav-link disabled">Tests: {{ $value }}</p>
                @endforeach
            @else
                <p class="nav-link disabled">Tests: N/A</p>
            @endif
        </li>
    @endif
</ul>