<div id="viewer-left-container">
    <div id="viewer-left-container-main">
        <!-- Files Container -->
        <div class="padding-10 left-files-container nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <label for="main_feedback">File System</label>
            @foreach ($files as $index => $file)
                <a @if ($index == 0) class="nav-link active" @else class="nav-link" @endif id="v-pills-{{$index}}-tab" data-toggle="pill" href="#v-pills-{{$index}}" role="tab" aria-controls="v-pills-{{$index}}" aria-selected="true">{{ $file->getRelativePathname() }}</a>
            @endforeach
        </div>

        @if ($submission != null)
            <!-- Description Container -->
            <div class="padding-10">
                <label for="main_feedback">Main Feedback</label>
                <textarea 
                    class="form-control main-feedback-container"
                    rows="6"
                    name="main_feedback"
                    id="main_feedback"
                    @if (!$isMarkable) disabled @endif>@if ($submission->main_feedback != null){{ $submission->main_feedback }}@endif
                </textarea>
            </div>

            <!-- Score Container -->
            <div class="padding-10">
                <label for="score">Score (0 - {{ $submission->coursework->maximum_score }})</label>
                <input
                    type="text"
                    class="form-control"
                    name="score"
                    id="score"
                    @if (!$isMarkable) disabled @endif
                    @if ($submission->score != null) value="{{$submission->score}}" @endif>
            </div>

            <!-- Line Comments Container -->
            <div class="padding-10">
                <label>Line Comments</label>
                <table id="line-comments-container-table">
                    @foreach (json_decode($submission->json)->comments as $lineNumber => $comment)

                        <tr class="comment-container" id="comment-container-{{$lineNumber}}">
                            <td class="comment-input-container">
                                <p>{{str_replace("_", " ", $lineNumber)}}</p>
                                <input type="text" class="form-control" name="{{$lineNumber}}" value="{{$comment}}" @if (!$isMarkable) disabled @endif>
                            </td>
                            @if ($isMarkable)
                                <td>
                                    <button type="button" class="checkmate-button" onclick="deleteLineComment({{$lineNumber}}">
                                        <img src="{{  Storage::url('/images/icon/dropdown-trash.png') }}" />
                                    </button>
                                </td>
                            @endif
                        </tr>

                    @endforeach
                </table>
            </div>
        @endif
    </div>

    <!-- Open/Close Container -->
    <div id="viewer-left-container-menu">
        <button type="button" id="viewer-left-container-menu-button" class="checkmate-button">
            <img src="{{  Storage::url('images/icon/chevron-right.png') }}" />
        </button>
    </div>
</div>