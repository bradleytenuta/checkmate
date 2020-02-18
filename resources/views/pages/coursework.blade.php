@extends ('layouts.main')

<!-- Begining of the Section-->
@section ('dynamic-main-content')

<!-- Content Container -->
<div class="content-container">
    <!-- Coursework Card -->
    @include('components.coursework.page.infobox', ['module'=>$coursework->module])

    <!-- Submission Container -->
    <div id="submission-container">
        <h1>Submission</h1>
        <div class="checkmate-form">
            <!-- Form for if the user is a student in coursework -->
            @if (\App\Utility\ModulePermission::hasRole($coursework->module, Auth::user(), 'student'))
                <form method="post" action="{{ route('coursework.submission.upload') }}" class="dropzone" id="courseworkDropzone">
                    @csrf
                </form>
            @endif
        </div>
    </div>
</div>

@endsection
<!-- End of the Section-->