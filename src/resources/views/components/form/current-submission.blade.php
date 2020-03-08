@php $previousSubmission = \App\Submission::where('coursework_id', $coursework->id)->where('user_id', Auth::user()->id)->first() @endphp

<!-- If the user did not submit coursework -->
@if ($previousSubmission == null)
    <div class="form-group row alert alert-primary" role="alert">
        <div class="col-sm-12">
            <h4 class="no-margin">No Submission - Submission Window Has Closed</h4>
        </div>
    </div>
@endif

<!-- If the user did submit some coursework -->
@if ($previousSubmission != null)
    <div class="form-group row alert alert-primary" role="alert">
        <div class="col-sm-12">
            <h4 class="no-margin">Submitted: {{ $previousSubmission->updated_at }}</h4>

            <!-- Only show submission details if its been marked -->
            @if ($previousSubmission->score != null)
                <h6>Score</h6>
                <p>{{ $previousSubmission->score }}</p>

                <!-- TODO: Display Unit test results -->
                <h6>Test Score</h6>
                <p>N/A</p>

                <h6>Main Feedback</h6>
                <p>{{ $previousSubmission->main_feedback }}</p>

                <!-- Button to view additonal feedback -->
                <a class="btn btn-primary" href="{{ route('viewer.student', ['module_id' => $coursework->module->id, 'coursework_id' => $coursework->id, 'submission_id' => $previousSubmission->id]) }}">View All Feedback</a>
            @endif
        </div>
    </div>
@endif