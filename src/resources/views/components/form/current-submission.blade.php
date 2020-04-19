@php $previousSubmission = \App\Submission::where('coursework_id', $coursework->id)->where('user_id', Auth::user()->id)->first() @endphp

<!-- If the user did not submit coursework -->
@if ($previousSubmission == null)
    <div class="form-group row alert alert-primary" role="alert">
        <div class="col-sm-12">
            @if ($coursework->open)
                <h4 class="no-margin">No Submission</h4>
            @else
                <h4 class="no-margin">No Submission - Submission Window Has Closed</h4>
            @endif
        </div>
    </div>
@else
    @php
        $submission_json_obj = json_decode($previousSubmission->json);
    @endphp
    <!-- If the user did submit some coursework -->
    <div class="form-group row alert alert-primary" role="alert">
        <div class="col-sm-12">
            <h4 class="no-margin">Submitted: {{ $previousSubmission->updated_at }}</h4>

            <!-- Only show submission details if its been marked -->
            <h6>Score</h6>
            @if ($previousSubmission->score == null)
                <p>N/A</p>
            @else
                <p>{{ $previousSubmission->score }}</p>
            @endif
            
            <!-- Test Results -->
            <h6>Test Score</h6>
            @if (!empty($submission_json_obj->test_results))
                @foreach ($submission_json_obj->test_results as $value)
                    <p>{{ $value }}</p>
                @endforeach
            @else
                <p>N/A</p>
            @endif

            <h6>Main Feedback</h6>
            @if ($previousSubmission->main_feedback == null)
                <p>N/A</p>
            @else
                <p>{{ $previousSubmission->main_feedback }}</p>
            @endif

            <!-- Button to view additonal feedback -->
            <a class="btn btn-primary" href="{{ route('viewer.student', ['module_id' => $coursework->module->id, 'coursework_id' => $coursework->id, 'submission_id' => $previousSubmission->id]) }}">View All Feedback</a>
        </div>
    </div>
@endif