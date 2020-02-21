@php $previousSubmission = \App\Submission::where('coursework_id', $coursework->id)->where('user_id', Auth::user()->id)->first() @endphp
@if ($previousSubmission != null)
    <div class="form-group row alert alert-primary" role="alert">
        <div class="col-sm-12">
            <h4 class="no-margin">Submitted: {{ $previousSubmission->updated_at }}</h4>

            <!-- Only show submission details if its been marked -->
            @if ($previousSubmission->score != null)
                <h6>Score</h6>
                <p>{{ $previousSubmission->score }}</p>

                <p>{{ $previousSubmission->main_feedback }}</p>

                <!-- Button to view additonal feedback -->
                <!-- TODO: Create view all feedback page -->
                <a class="btn btn-primary" href="#">View All Feedback</a>
            @endif
        </div>
    </div>
@endif