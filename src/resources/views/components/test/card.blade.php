<div class="card-body">
    <!-- Card Title -->
    <h5>{{ $test->file_name }}</h5>

    <!-- Card Description -->
    <p class="card-text">
        @if ($test->public)
            Public
        @else
            Private
        @endif
    </p>

    <!-- View Test -->
    <a href="{{ route('viewer.test', ['module_id' => $test->coursework->module->id, 'coursework_id' => $test->coursework->id, 'test_id' => $test->id]) }}" class="card-link">Open</a>

    <!-- Delete Test -->
    @if ($test->coursework->open)
        <a href="#" class="card-link" onclick="event.preventDefault(); document.getElementById('delete-test-form').submit();">
            Delete
        </a>
        <form id="delete-test-form" action="{{ route('test.delete', ['module_id' => $test->coursework->module->id, 'coursework_id' => $test->coursework->id, 'test_id' => $test->id]) }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endif
</div>