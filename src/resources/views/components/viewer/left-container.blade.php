<div id="viewer-left-container" class="">
    <div id="viewer-left-container-main">
        <!-- Files Container -->
        <div class="padding-10 left-container-files nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <label for="main_feedback">File System</label>
            @foreach ($files as $index => $file)
                <a @if ($index == 0) class="nav-link active" @else class="nav-link" @endif id="v-pills-{{$index}}-tab" data-toggle="pill" href="#v-pills-{{$index}}" role="tab" aria-controls="v-pills-{{$index}}" aria-selected="true">{{ $file->getRelativePathname() }}</a>
            @endforeach
        </div>

        <!-- Description Container -->
        <div class="padding-10">
            <label for="main_feedback">Main Feedback</label>
            <textarea class="form-control main-feedback-container" rows="6" name="main_feedback" id="main_feedback">
                @if ($submission->main_feedback != null)
                    {{ $submission->main_feedback }}
                @endif
            </textarea>
        </div>

        <!-- Line Comments Container -->
        <div class="padding-10">
            <label>Line Comments</label>
            <!-- Template -->
            <!-- <input type="text" class="form-control" name="line-comment-1" id="line-comment-1"> -->
            <div class="commment-container">
                <p>1</p>
                <input type="text" class="form-control" name="line-comment-1" id="line-comment-1">
                <button type="button" class="checkmate-button">
                    <img src="{{  Storage::url('images/icon/dropdown-trash.png') }}" />
                </button>
            </div>
        </div>
    </div>

    <!-- Open/Close Container -->
    <div class="viewer-left-container-menu">
        <button type="button" id="viewer-left-container-menu-button" class="checkmate-button">
            <img src="{{  Storage::url('images/icon/chevron-left.png') }}" />
        </button>
    </div>
</div>