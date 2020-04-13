<div class="viewer-right-container tab-content" id="v-pills-tabContent">
            
    @foreach ($files as $index => $file)
        <div @if ($index == 0) class="viewer-code-container tab-pane fade show active" @else class="tab-pane fade" @endif id="v-pills-{{$index}}" role="tabpanel" aria-labelledby="v-pills-{{$index}}-tab">
            @foreach (explode(PHP_EOL, $file->getContents()) as $lineIndex => $line)
                <div class="viewer-row @if($isMarkable) viewer-row-hover @endif" @if($isMarkable) onclick="makeLineComment('{{$file->getRelativePathname()}} - {{($lineIndex + 1)}}')" @endif>
                    <div class="viewer-number-container">{{$lineIndex + 1}}@if($isMarkable)<img src="{{  Storage::url('/images/icon/comment.png') }}" />@endif</div>
                    <div class="viewer-line-container">
                        <pre>{{ \App\Utility\Viewer::formatLine($line) }}</pre>
                    </div>
                </div>
            @endforeach
            </div>
    @endforeach

</div>