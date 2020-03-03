<!-- Loops through all the submissions in the coursework and creates containers for them -->
<div class="col-sm-12">
    <table>
        @foreach ($coursework->submissions as $submission)
            <tr class="submission-container">
                <td>User ID: {{ $submission->user->id }}</td>
                <td>Name: {{ $submission->user->firstname }} {{ $submission->user->surname }}</td>

                <!-- Shows the submission score -->
                @if ($submission->score != null)
                    <td>Score: {{ $submission->score }}</td>
                @else
                    <td>Score: N/A</td>
                @endif

                <!-- Shows if the submission has been marked -->
                @if ($submission->marker_id != null)
                    @php $markerUser = \App\User::where('id', $submission->marker_id)->first(); @endphp
                    <td>Marker: {{ $markerUser->firstname }} {{ $markerUser->surname }}</td>
                    <!-- Button to mark submission -->
                    <td><a href="{{ route('viewer.mark', ['module_id' => $coursework->module->id, 'coursework_id' => $coursework->id, 'submission_id' => $submission->id]) }}" type="button" class="btn btn-primary">
                        <img class="page-title-button-image" src="{{ Storage::url('/images/icon/mark-submission.png') }}" />
                        Remark
                    </a></td>
                @else
                    <td>Marker: N/A</td>
                    <!-- Button to mark submission -->
                    <td><a href="{{ route('viewer.mark', ['module_id' => $coursework->module->id, 'coursework_id' => $coursework->id, 'submission_id' => $submission->id]) }}" type="button" class="btn btn-primary">
                        <img class="page-title-button-image" src="{{ Storage::url('/images/icon/mark-submission.png') }}" />
                        Mark
                    </a></td>
                @endif
            </tr>
        @endforeach
    </table>
</div>

<!-- Display empty message if no cards shown -->
@include('components.alert.empty-submission', ['cards' => $coursework->submissions, 'name' => 'Submissions'])