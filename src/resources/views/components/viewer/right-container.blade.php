<div class="viewer-right-container tab-content" id="v-pills-tabContent">
            
    @foreach ($files as $index => $file)
        <div class="@if ($index == 0) show active @endif tab-pane fade" id="v-pills-{{$index}}" role="tabpanel" aria-labelledby="v-pills-{{$index}}-tab">
            @foreach (explode(PHP_EOL, $file->getContents()) as $lineIndex => $line)
                <div class="viewer-row @if($isMarkable) viewer-row-hover @endif" @if($isMarkable) onclick="makeLineComment('{{$file->getRelativePathname()}} - {{($lineIndex + 1)}}')" @endif>
                    <div class="viewer-number-container">{{$lineIndex + 1}}@if($isMarkable)<img src="{{  Storage::url('/images/icon/comment.png') }}" />@endif</div>
                    <div class="viewer-line-container">
                        <pre><code class="java">{{ \App\Utility\Viewer::formatLine($line) }}</code></pre>
                    </div>
                </div>
            @endforeach
            </div>
    @endforeach

</div>