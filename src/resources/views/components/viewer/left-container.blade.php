<div id="viewer-left-container">
    <div id="viewer-left-container-main">
        <!-- Files Container -->
        <div class="padding-10 left-files-container nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <label for="main_feedback">File System</label>
            @foreach ($files as $index => $file)
                <a @if ($index == 0) class="nav-link active" @else class="nav-link" @endif id="v-pills-{{$index}}-tab" data-toggle="pill" href="#v-pills-{{$index}}" role="tab" aria-controls="v-pills-{{$index}}" aria-selected="true">{{ $file->getRelativePathname() }}</a>
            @endforeach
        </div>

        <!-- Description Container -->
        <div class="padding-10">
            <label for="main_feedback">Main Feedback</label>
            <textarea class="form-control main-feedback-container" rows="6" name="main_feedback" id="main_feedback" @if (!$isMarkable) disabled @endif>
                @if ($submission->main_feedback != null)
                    {{ $submission->main_feedback }}
                @endif
            </textarea>
        </div>

        <!-- Line Comments Container -->
        <div class="padding-10">
            <label>Line Comments</label>
            <table id="line-comments-container-table">
                <!-- TODO Load in all in line comments from submission JSON -->
            </table>
        </div>
    </div>

    <!-- Open/Close Container -->
    <div id="viewer-left-container-menu">
        <button type="button" id="viewer-left-container-menu-button" class="checkmate-button">
            <img src="{{  Storage::url('images/icon/chevron-right.png') }}" />
        </button>
    </div>
</div>