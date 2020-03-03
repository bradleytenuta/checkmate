@extends ('layouts.main')
<!-- TODO: remove footer -->
<!-- TODO: make page 100% height -->

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- The form used to mark the coursework. Only contains an action if the user has permission to mark it -->
<form method="POST" @if ($isMarkable) action="{{ route('viewer.mark.save', ['module_id' => $submission->coursework->module->id, 'coursework_id' => $submission->coursework->id, 'submission_id' => $submission->id]) }}" @endif>

    <!-- Viewer menu bar -->
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

    <!-- Main container -->
    <div class="viewer-main-container">

        <!-- Left Side Container -->
        <div class="viewer-left-container">

            <!-- Menu Container -->
            <div class="padding-10 left-container-menu closed">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <button type="button" class="checkmate-button">
                            <img src="{{  Storage::url('/images/icon/chevron-right.png') }}" />
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Files Container -->
            <div>
                <div class="left-container-heading">File System</div>
                <div class="padding-10 left-container-files nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @foreach ($files as $index => $file)
                        <a @if ($index == 0) class="nav-link active" @else class="nav-link" @endif id="v-pills-{{$index}}-tab" data-toggle="pill" href="#v-pills-{{$index}}" role="tab" aria-controls="v-pills-{{$index}}" aria-selected="true">{{ $file->getRelativePathname() }}</a>
                    @endforeach
                </div>
            </div>

            <!-- Description Container -->
            <div>
                <div class="left-container-heading">Submission Information</div>
                <div class="padding-10">
                </div>
            </div>
        </div>

        <!-- Source code container -->
        <div class="viewer-right-container tab-content" id="v-pills-tabContent">
            
            @foreach ($files as $index => $file)
                <div @if ($index == 0) class="viewer-code-container tab-pane fade show active" @else class="tab-pane fade" @endif id="v-pills-{{$index}}" role="tabpanel" aria-labelledby="v-pills-{{$index}}-tab">
                    @foreach (explode(PHP_EOL, $file->getContents()) as $lineIndex => $line)
                        <div class="viewer-row">
                            <div class="viewer-number-container">{{$lineIndex}}<img src="{{  Storage::url('/images/icon/comment.png') }}" />
                            </div>
                            <div class="viewer-line-container">
                                <pre>{{ \App\Utility\Viewer::formatLine($line) }}</pre>
                            </div>
                        </div>
                    @endforeach
                    </div>
            @endforeach

        </div>
    </div>

</form>

@endsection
<!-- End of the Section-->